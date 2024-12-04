<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Kpi;
use App\Models\User;
use App\Models\Harian;
use App\Models\Mingguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

class GmController extends Controller
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

        return view('gm.dashboard', [
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
    public function adduser()
    {
        return view('gm.adduser.index');
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
        return redirect()->route('add.user')->with('success', 'Penambahan Manager Telah Berhasil');
    }

    public function print()
    {
        return view('gm.print.index');
    }

    public function viewkpi()
    {
        $kpis = Kpi::all();
        return view('gm.kpi.index', compact('kpis'));
    }
    public function kpi()
    {
        $kpis = Kpi::all();
        return view('gm.kpi.addkpi', compact('kpis'));
    }

    public function add_kpi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',  // Validate jabatan
            'desc' => 'required|string|max:255',     // Validate desc
            'bobot' => 'required|numeric',           // Validate bobot (decimal)
            'target' => 'required|numeric',          // Validate target (decimal)
            'realisasi' => 'required|numeric',       // Validate realisasi (decimal)
        ]);

        $skor = ($request->realisasi / $request->target) * 100;
        $finalSkor = ($skor * $request->bobot) / 100;

        Kpi::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,       // Insert jabatan
            'desc' => $request->desc,             // Insert desc
            'bobot' => $request->bobot,           // Insert bobot
            'target' => $request->target,         // Insert target
            'realisasi' => $request->realisasi,   // Insert realisasi
            'skor' => $skor,                      // Insert skor
            'final_skor' => $finalSkor,           // Insert final_skor
        ]);

        return redirect()->route('kpi')->with('success', 'KPI added successfully!');
    }

    public function kpiedit($id)
    {
        $kpi = Kpi::find($id);
        return view('gm.kpi.edit', compact('kpi'));
    }

    public function kpiupdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',  // Validate jabatan
            'desc' => 'required|string|max:255',     // Validate desc
            'bobot' => 'required|numeric',           // Validate bobot (decimal)
            'target' => 'required|numeric',          // Validate target (decimal)
            'realisasi' => 'required|numeric',       // Validate realisasi (decimal)
        ]);

        $score = ($request->realization / $request->target) * 100;
        $finalScore = ($score * $request->weight) / 100;

        $kpi = Kpi::find($id);
        $kpi->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,       // Insert jabatan
            'desc' => $request->desc,             // Insert desc
            'bobot' => $request->bobot,           // Insert bobot
            'target' => $request->target,         // Insert target
            'realisasi' => $request->realisasi,   // Insert realisasi

        ]);

        return redirect()->route('kpi')->with('success', 'KPI updated successfully!');
    }
    public function kpidestroy($id)
    {
        Kpi::destroy($id);
        return redirect()->route('kpi')->with('success', 'KPI deleted successfully!');
    }
}
