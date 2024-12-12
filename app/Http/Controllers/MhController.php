<?php

namespace App\Http\Controllers;

// use PDF;
use Carbon\Carbon;
use App\Models\Kpi;
use App\Models\User;
use App\Models\Harian;
use App\Models\kinerja;
use App\Models\Mingguan;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\KpiExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

class MhController extends Controller
{

    public function KPIexportPDF(Request $request, $type)
    {
        // Get filter parameters from the request
        $search = $request->input('search');
        $bulan = $request->input('bulan', '');
        $tahun = $request->input('tahun', '');

        // Build the KPI query with filters
        $kpisQuery = Kpi::query();

        // Apply filters
        $kpis = Kpi::when(
            $search,
            function ($query, $search) {
                $query->whereHas('user', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%');
                });
            }
        )
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('created_at', $tahun);
            })
            ->get();

        // Redirect if no data found
        if ($kpis->isEmpty()) {
            return redirect()->route('kpi')->with('message', 'No data found for export.');
        }

        // Calculate scores and derive additional data
        $totalFinalSkor = $kpis->sum('final_skor');
        $kinerja = Kpi::when($bulan, function ($query) use ($bulan) {
            $query->whereMonth('created_at', $bulan);
        })->when($tahun, function ($query) use ($tahun) {
            $query->whereYear('created_at', $tahun);
        })->sum('skor');

        $hasilAkhir = $totalFinalSkor + $kinerja;
        $kategori = $hasilAkhir >= 75 ? 'Excellent' : ($hasilAkhir >= 50 ? 'Good' : 'Needs Improvement');

        // Prepare data for PDF
        $data = compact('kpis', 'type', 'search', 'bulan', 'tahun', 'totalFinalSkor', 'kinerja', 'hasilAkhir', 'kategori');

        // Generate PDF
        $pdf = PDF::loadView('mh.exports.kpi-pdf', $data);
        return $pdf->download('kpi-report.pdf');
    }


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
        $search_name = $request->input('search'); // Name filter
        $bulan = $request->input('bulan'); // Month filter
        $tahun = $request->input('tahun'); // Year filter

        // Array of month names in Indonesian
        $months = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Apply filters to the KPI query
        $kpis = Kpi::when($search_name, function ($query, $search_name) {
            return $query->where('nama', 'like', '%' . $search_name . '%');
        })
            ->when($bulan, function ($query) use ($bulan) {
                // Filter by month from created_at
                return $query->whereMonth('created_at', '=', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                // Filter by year from created_at
                return $query->whereYear('created_at', '=', $tahun);
            })
            ->get();

        // Check if there are no results
        $noResults = $kpis->isEmpty();

        // Calculate the total final score based on the filtered KPIs
        $totalFinalSkor = $noResults ? 0 : $kpis->sum('final_skor');

        $totalBobot = $kpis->sum('bobot');

        // Fetch users for the dropdown if needed
        $users = User::where('role', 'hrd')->select('name', 'jabatan')->get();

        // Apply filters to the Kinerja query
        $kinerja = Kinerja::when($search_name, function ($query, $search_name) {
            return $query->whereHas('user', function ($subQuery) use ($search_name) {
                $subQuery->where('name', 'like', '%' . $search_name . '%');
            });
        })
            ->when($bulan, function ($query) use ($bulan) {
                // Filter by month from created_at
                return $query->whereMonth('created_at', '=', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                // Filter by year from created_at
                return $query->whereYear('created_at', '=', $tahun);
            })
            ->get();

        // Calculate the total kinerja score using the provided formula
        $nilaiKinerja = $kinerja->pluck('nilai')->toArray();
        $totalNilai = count($nilaiKinerja) >= 5 ? (array_sum($nilaiKinerja) / 5) * 20 : 0;


        // Return the view with data
        return view('mh.kpi.index', compact(
            'kpis',
            'users',
            'search_name',
            'bulan',
            'tahun',
            'noResults',
            'totalFinalSkor',
            'months',
            'totalBobot',
            'kinerja',
            'totalNilai' // Pass totalNilai to the view
        ));
    }

    public function kinerjaIndex()
    {
        // Retrieve all kinerja data with associated users
        $kinerja = Kinerja::with('user')->get();
        return view('mh.kinerja.index', compact('kinerja'));
    }

    // Display form for adding Kinerja
    public function addkinerja()
    {
        // // Fetch all users to display in the form
        $users = User::where('role', 'hrd')->select('id', 'name', 'jabatan')->get();

        return view('mh.kinerja.add', compact('users'));
    }

    public function storekinerja(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama' => 'required|exists:users,id',
            'perilaku' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1|max:5',
        ]);

        // Simpan data Kinerja
        Kinerja::create([
            'user_id' => $validatedData['nama'],
            'perilaku' => $validatedData['perilaku'],
            'nilai' => $validatedData['nilai'],
        ]);

        // Redirect ke route KPI dengan pesan sukses
        return redirect()->route('add.kinerja')->with('success', 'Data Kinerja berhasil ditambahkan.');
    }

    // Display form for editing Kinerja
    public function editkinerja($id)
    {
        // Retrieve the specific Kinerja record and all users
        $kinerja = Kinerja::findOrFail($id);
        $users = User::select('id', 'name')->get();
        return view('mh.kinerja.edit', compact('kinerja', 'users'));
    }

    // Handle Kinerja update
    public function updatekinerja(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'nama' => 'required|exists:users,id',
            'perilaku' => 'required|string',
            'nilai' => 'required|integer|min:1|max:5',

        ]);

        // Find and update the specific Kinerja record
        $kinerja = Kinerja::findOrFail($id);
        $kinerja->update([
            'user_id' => $request->input('nama'), // Correctly pass user_id
            'perilaku' => $request->input('perilaku'),
            'nilai' => $request->input('nilai'),

        ]);

        return redirect()->route('kpi')->with('success', 'Data Kinerja berhasil diperbarui.');
    }

    // Handle Kinerja deletion
    public function deletekinerja($id)
    {
        // Find and delete the specific Kinerja record
        $kinerja = Kinerja::findOrFail($id);
        $kinerja->delete();

        return redirect()->route('kpi')->with('success', 'Data Kinerja berhasil dihapus.');
    }

    public function kpi(Request $request)
    {
        // Fetch the 'jabatan' from the request
        $jabatan = $request->input('jabatan');

        $kpis = KPI::where('jabatan', $jabatan)
            ->orderBy('bobot', 'desc') // Urutkan berdasarkan bobot
            ->get(['desc', 'bobot']);

        // Fetch users with role 'hrd'
        $users = User::where('role', 'hrd')->select('name', 'jabatan')->get();

        // Pass users and KPIs to the view
        return view('mh.kpi.addkpi', compact('users', 'kpis'));
    }

    public function getKpisByJabatan(Request $request)
    {
        $jabatan = $request->input('jabatan');

        if ($jabatan) {
            $kpis = KPI::where('jabatan', $jabatan)->get(['desc', 'bobot']);
            return response()->json($kpis);
        }

        return response()->json([]);
    }



    public function add_kpi(Request $request)
    {
        // Validate inputs
        $validatedData = $request->validate([
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
            'desc' => 'required|string',
            'bobot' => 'required|string',
            'target' => 'required|numeric|min:0',
            'realisasi' => 'required|numeric|min:0',

        ]);

        // Calculate scores
        $skor = ($request->realisasi / $request->target) * 100;
        $finalSkor = ($skor * $request->bobot) / 100;

        // Save KPI record
        Kpi::create([
            'nama' => $validatedData['nama'],
            'jabatan' => $validatedData['jabatan'],
            'desc' => $validatedData['desc'],
            'bobot' => $validatedData['bobot'],
            'target' => $validatedData['target'],
            'realisasi' => $validatedData['realisasi'],
            'skor' => $skor,
            'final_skor' => $finalSkor,

        ]);

        // Redirect to KPI page with success message
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
