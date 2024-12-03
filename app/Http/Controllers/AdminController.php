<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Harian;
use App\Models\Mingguan;

class AdminController extends Controller
{
    public function index()
    {
        // Existing calculations
        $totalUsers = User::count();
        $reportsSubmitted = Harian::count() + Mingguan::count();
        $pendingTasks = Harian::where('status', 0)->count() + Mingguan::where('status', 0)->count();
        $acceptedTasks = Harian::where('status', 1)->count() + Mingguan::where('status', 1)->count();
        $rejectedTasks = Harian::where('status', 2)->count() + Mingguan::where('status', 2)->count();

        // Recent activities
        $recentActivities = DB::table('harian')
            ->select(
                'harian.date',
                'harian.id_marketing as user_id',
                DB::raw('CASE WHEN harian.status = 1 THEN "Uploaded" ELSE "Submitted Report" END as action'),
                'harian.status',
                'users.name as user_name'
            )
            ->join('users', 'users.id', '=', 'harian.id_marketing')
            ->union(
                DB::table('mingguan')
                    ->select(
                        'mingguan.periode as date',
                        'mingguan.id_marketing as user_id',
                        DB::raw('CASE WHEN mingguan.status = 1 THEN "Uploaded" ELSE "Created Task" END as action'),
                        'mingguan.status',
                        'users.name as user_name'
                    )
                    ->join('users', 'users.id', '=', 'mingguan.id_marketing')
            )
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();

        // Check if all reports for each user have been uploaded
        $uploadedStatus = DB::table('users')
            ->leftJoin('harian', 'users.id', '=', 'harian.id_marketing')
            ->leftJoin('mingguan', 'users.id', '=', 'mingguan.id_marketing')
            ->select('users.id', 'users.name')
            ->selectRaw('COUNT(harian.id) as total_harian')
            ->selectRaw('COUNT(mingguan.id) as total_mingguan')
            ->selectRaw('SUM(CASE WHEN harian.status = 1 THEN 1 ELSE 0 END) as uploaded_harian')
            ->selectRaw('SUM(CASE WHEN mingguan.status = 1 THEN 1 ELSE 0 END) as uploaded_mingguan')
            ->groupBy('users.id', 'users.name')
            ->get()
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->total_harian + $user->total_mingguan == $user->uploaded_harian + $user->uploaded_mingguan ? 'Uploaded All' : 'Sudah Upload'];
            });

        // Prepare data for the performance chart
        $performanceData = User::with([
            'harian' => function ($query) {
                $query->selectRaw('id_marketing, status, COUNT(*) as count')
                    ->groupBy('id_marketing', 'status');
            },
            'mingguan' => function ($query) {
                $query->selectRaw('id_marketing, status, COUNT(*) as count')
                    ->groupBy('id_marketing', 'status');
            }
        ])
            ->where('role', 'marketing')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'accepted' => $user->harian->where('status', 1)->sum('count') + $user->mingguan->where('status', 1)->sum('count'),
                    'rejected' => $user->harian->where('status', 2)->sum('count') + $user->mingguan->where('status', 2)->sum('count'),
                    'total' => $user->harian->sum('count') + $user->mingguan->sum('count')
                ];
            });

        $marketingUsers = User::where('role', 'marketing')->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'reportsSubmitted' => $reportsSubmitted,
            'pendingTasks' => $pendingTasks,
            'acceptedTasks' => $acceptedTasks,
            'rejectedTasks' => $rejectedTasks,
            'recentActivities' => $recentActivities,
            'uploadedStatus' => $uploadedStatus,
            'performanceData' => $performanceData,
            'marketingUsers' => $marketingUsers
        ]);
    }

    public function manager()
    {
        return view('admin.manager.index');
    }

    public function laporanMmHarian($type)
    {
        $status = $type == 'approve' ? 1 : 2;

        // Ambil project yang terenkripsi dari request
        $encryptedProject = request('project', null);
        $project = $encryptedProject ? Crypt::decrypt($encryptedProject) : 'all';

        // Filter data berdasarkan status dan project
        $harian = Harian::where('status', $status)
            ->when($project != 'all', function ($query) use ($project) {
                return $query->where('project', $project);
            })
            ->with('marketing')
            ->get();

        $title = $type == 'approve' ? 'Data Diterima' : 'Data Ditolak';

        return view('admin.manager.marketing.harian.index', compact('harian', 'title', 'type'));
    }

    public function laporanMmMingguan($type)
    {
        $status = $type == 'approve' ? 1 : 2;

        // Ambil project yang terenkripsi dari request
        $encryptedProject = request('project', null);
        $project = $encryptedProject ? Crypt::decrypt($encryptedProject) : 'all';

        // Filter data berdasarkan status dan project
        $mingguan = Mingguan::where('status', $status)
            ->when($project != 'all', function ($query) use ($project) {
                return $query->where('projectArea', $project);
            })
            ->with('marketing')
            ->get();

        $title = $type == 'approve' ? 'Data Diterima' : 'Data Ditolak';

        return view('admin.manager.marketing.mingguan.index', compact('mingguan', 'title', 'type'));
    }

    public function adduser()
    {
        return view('admin.adduser.index');
    }

    public function doadduser(Request $request)
    {
        // Validasi input datadoregister
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect ke halaman tertentu setelah berhasil registrasi
        return redirect()->route('admin')->with('success', 'Registration successful, please login!');
    }
}
