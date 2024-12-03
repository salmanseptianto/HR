<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\user;
use App\Models\Harian;
use App\Models\Mingguan;
use Illuminate\Support\Facades\Storage;

class MarketingController extends Controller
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
            ->select('harian.date', 'harian.id_marketing as user_id', DB::raw('CASE WHEN harian.status = 1 THEN "Uploaded" ELSE "Submitted Report" END as action'), 'harian.status', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'harian.id_marketing')
            ->union(DB::table('mingguan')->select('mingguan.periode as date', 'mingguan.id_marketing as user_id', DB::raw('CASE WHEN mingguan.status = 1 THEN "Uploaded" ELSE "Created Task" END as action'), 'mingguan.status', 'users.name as user_name')->join('users', 'users.id', '=', 'mingguan.id_marketing'))
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
                $query->selectRaw('id_marketing, status, COUNT(*) as count')->groupBy('id_marketing', 'status');
            },
            'mingguan' => function ($query) {
                $query->selectRaw('id_marketing, status, COUNT(*) as count')->groupBy('id_marketing', 'status');
            },
        ])
            ->where('role', 'marketing')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'accepted' => $user->harian->where('status', 1)->sum('count') + $user->mingguan->where('status', 1)->sum('count'),
                    'rejected' => $user->harian->where('status', 2)->sum('count') + $user->mingguan->where('status', 2)->sum('count'),
                    'total' => $user->harian->sum('count') + $user->mingguan->sum('count'),
                ];
            });

        $marketingUsers = User::where('role', 'marketing')->get();

        return view('marketing.dashboard', [
            'totalUsers' => $totalUsers,
            'reportsSubmitted' => $reportsSubmitted,
            'pendingTasks' => $pendingTasks,
            'acceptedTasks' => $acceptedTasks,
            'rejectedTasks' => $rejectedTasks,
            'recentActivities' => $recentActivities,
            'uploadedStatus' => $uploadedStatus,
            'performanceData' => $performanceData,
            'marketingUsers' => $marketingUsers,
        ]);
    }

    public function harian()
    {
        $userId = auth()->id();
        //  $harianData = Harian::with('marketing')->get();
        $harianData = Harian::where('id_marketing', $userId)->get();

        return view('marketing.harian.index', compact('harianData'));
    }

    public function addharian(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'project' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat' => 'required|string',
            'prospek' => 'required|string',
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file foto
        ]);

        // $fotoPath = null;
        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoPath = $foto->store('marketing/harian', 'public');
        // }

        // Simpan data ke database
        Harian::create([
            'id_marketing' => auth()->id(),
            'date' => now(),
            'nama' => $request->nama,
            'project' => $request->project,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'prospek' => $request->prospek,
            // 'foto' => $fotoPath,
        ]);

        return redirect()->route('marketing')->with('success', 'Data berhasil disimpan!');
    }

    public function harianedit($id)
    {
        $enkId = Crypt::decrypt($id);
        $userId = auth()->id();
        $harian = Harian::findOrFail($enkId);

        if ($harian->id_marketing !== $userId) {
            return view('errors.404');
        }
        return view('marketing.harian.edit', compact('harian'));
    }

    // public function harianupdate(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'project' => 'required|string',
    //         'leads' => 'nullable|string',
    //         'aktivitas' => 'nullable|string',
    //     ]);

    //     $enkId = Crypt::decrypt($id);
    //     $harian = Harian::findOrFail($enkId);
    //     $harian->update($validatedData);

    //     return redirect()->route('harian')->with('success', 'Data berhasil diperbarui!');
    // }

    public function harianupdate(Request $request, $id)
    {
        // Validate input form
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'project' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat' => 'required|string',
            'prospek' => 'required|string',
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for photo
        ]);

        $enkId = Crypt::decrypt($id);
        $userId = auth()->id();
        $harian = Harian::findOrFail($enkId);

        if ($harian->id_marketing !== $userId) {
            return view('errors.404');
        }

        // $fotoPath = $harian->foto; // Keep existing photo path if not updated
        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoPath = $foto->store('marketing/harian', 'public');
        // }

        // Update data in the database
        $harian->update([
            'nama' => $request->nama,
            'project' => $request->project,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'prospek' => $request->prospek,
            // 'foto' => $fotoPath,
        ]);

        return redirect()->route('marketing')->with('success', 'Data berhasil diperbarui!');
    }

    public function hariandestroy($id)
    {
        $enkId = Crypt::decrypt($id);
        $harian = Harian::findOrFail($enkId);

        if ($harian->foto) {
            Storage::delete('public/' . $harian->foto);
        }

        $harian->delete();

        return redirect()->route('harian')->with('success', 'Data berhasil dihapus!');
    }

    public function mingguan()
    {
        $userId = auth()->id();
        $mingguanData = Mingguan::where('id_marketing', $userId)->get();

        return view('marketing.mingguan.index', compact('mingguanData'));
    }

    public function addmingguan(Request $request)
    {
        $validatedData = $request->validate([
            'projectArea' => 'required|string',
            'periode' => 'required|date',
            'totalJumlahKanva' => 'required|string',
            'jumlahKanvasTimSeminggu' => 'required|integer',
            'iklanOnline' => 'required|string',
            'postingSosmed' => 'required|string',
            'janjiTemuDanKunjungan' => 'required|string',
            'calonKonsCekLokasi' => 'required|string',
            'totalDataLeads' => 'required|integer',
            'dataProspek' => 'required|string',
            'hotProspek' => 'required|string',
            'booking' => 'required|string',
            'pemberkasan' => 'required|string',
            'closingAkadCash' => 'required|numeric',
            'rencanaTargetClosingDalam1Bulan' => 'required|string',
        ]);

        Mingguan::create([
            'id_marketing' => auth()->id(),
            'projectArea' => $request->projectArea,
            'periode' => $request->periode,
            'totalJumlahKanva' => $request->totalJumlahKanva,
            'jumlahKanvasTimSeminggu' => $request->jumlahKanvasTimSeminggu,
            'iklanOnline' => $request->iklanOnline,
            'postingSosmed' => $request->postingSosmed,
            'janjiTemuDanKunjungan' => $request->janjiTemuDanKunjungan,
            'calonKonsCekLokasi' => $request->calonKonsCekLokasi,
            'totalDataLeads' => $request->totalDataLeads,
            'dataProspek' => $request->dataProspek,
            'hotProspek' => $request->hotProspek,
            'booking' => $request->booking,
            'pemberkasan' => $request->pemberkasan,
            'closingAkadCash' => $request->closingAkadCash,
            'rencanaTargetClosingDalam1Bulan' => $request->rencanaTargetClosingDalam1Bulan,
        ]);

        return redirect()->route('marketing')->with('success', 'Data mingguan berhasil disimpan');
    }

    public function mingguanedit($id)
    {
        $enkId = Crypt::decrypt($id);
        $userId = auth()->id();
        $mingguan = Mingguan::findOrFail($enkId);

        if ($mingguan->id_marketing !== $userId) {
            return view('errors.404');
        }
        return view('marketing.mingguan.edit', compact('mingguan'));
    }

    public function mingguanupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'projectArea' => 'required|string',
            'periode' => 'required|date',
            'totalJumlahKanva' => 'required|string',
            'jumlahKanvasTimSeminggu' => 'required|integer',
            'iklanOnline' => 'required|string',
            'postingSosmed' => 'required|string',
            'janjiTemuDanKunjungan' => 'required|string',
            'calonKonsCekLokasi' => 'required|string',
            'totalDataLeads' => 'required|integer',
            'dataProspek' => 'required|string',
            'hotProspek' => 'required|string',
            'booking' => 'required|string',
            'pemberkasan' => 'required|string',
            'closingAkadCash' => 'required|numeric',
            'rencanaTargetClosingDalam1Bulan' => 'required|string',
        ]);

        $enkId = Crypt::decrypt($id);
        $mingguan = Mingguan::findOrFail($enkId);
        $mingguan->update($validatedData);

        return redirect()->route('mingguan')->with('success', 'Data mingguan berhasil diperbarui');
    }

    public function mingguandestroy($id)
    {
        $enkId = Crypt::decrypt($id);
        $mingguan = Mingguan::findOrFail($enkId);
        $mingguan->delete();

        return redirect()->route('mingguan')->with('success', 'Data mingguan berhasil dihapus');
    }
}
