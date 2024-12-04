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
use Carbon\Carbon;

class MhController extends Controller
{
    public function index()
    {
        return view('mh.dashboard');
    }

    public function adduser()
    {
        $users = User::where('role', 'hrd')->get(); 
        return view('mh.adduser.index', compact('users'));
    }


    public function deleteuser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();  // Delete the user

        return redirect()->route('add.user')->with('success', 'User deleted successfully!');
    }


    public function doadduser(Request $request)
    {
        // Validasi input datadoregister
        $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user with correct field mappings
        User::create([
            'name' => $request->name,
            'jabatan' => $request->jabatan, // Corrected this line
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect ke halaman tertentu setelah berhasil registrasi
        return redirect()->route('add.user')->with('success', 'Berhasil Menambahkan Karyawan');
    }


    public function print()
    {
        return view('mh.print.index');
    }

    public function viewkpi(Request $request)
    {
        // Get search parameters
        $search_name = $request->input('search');
        $search_jabatan = $request->input('search_jabatan');
        $search_tanggal = $request->input('search_tanggal');

        // Apply filters to the KPI query
        $kpis = Kpi::when($search_name, function ($query, $search_name) {
            return $query->where('nama', 'like', '%' . $search_name . '%');
        })
            ->when($search_jabatan, function ($query, $search_jabatan) {
                return $query->where('jabatan', 'like', '%' . $search_jabatan . '%');
            })
            ->when($search_tanggal, function ($query, $search_tanggal) {
                return $query->whereDate('tanggal', $search_tanggal); // Filter by date
            })
            ->get();

        // Fetch users for dropdown if needed
        $users = User::where('role', 'hrd')->select('name', 'jabatan')->get();

        return view('mh.kpi.index', compact('kpis', 'users', 'search_name', 'search_jabatan', 'search_tanggal'));
    }

    public function kpi()
    {
        // Fetch all users with role 'marketing' and include 'name' and 'jabatan'
        $users = User::where('role', 'hrd')->select('name', 'jabatan')->get();

        // Pass users to the view
        return view('mh.kpi.addkpi', compact('users'));
    }

    public function add_kpi(Request $request)
    {
        // Validate the request with additional validation for nama and jabatan
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!User::where('name', $value)->exists()) {
                        $fail('The selected name does not exist in the users table.');
                    }
                },
            ],
            'jabatan' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if (!User::where('name', $request->nama)->where('jabatan', $value)->exists()) {
                        $fail('The provided position does not match the user.');
                    }
                },
            ],
            'desc' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'target' => 'required|numeric|min:0',
            'realisasi' => 'required|numeric|min:0',
        ]);

        // Calculate the scores
        $skor = ($request->realisasi / $request->target) * 100;
        $finalSkor = ($skor * $request->bobot) / 100;

        // Get the current date using Carbon
        $tanggal = $request->input('date') ?? Carbon::now()->format('Y-m-d');
        // Create a new KPI record
        Kpi::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'desc' => $request->desc,
            'bobot' => $request->bobot,
            'target' => $request->target,
            'realisasi' => $request->realisasi,
            'skor' => $skor,
            'final_skor' => $finalSkor,
            'tanggal' => $tanggal,  // Store the current date
        ]);

        // Redirect to the KPI page with a success message
        return redirect()->route('kpi')->with('success', 'KPI added successfully!');
    }

    public function kpiedit($id)
    {
        $kpi = Kpi::find($id);
        return view('mh.kpi.edit', compact('kpi'));
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
