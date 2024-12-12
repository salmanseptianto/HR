<?php

namespace App\Http\Controllers;

// use PDF;
use App\Models\Kpi;
use App\Models\kinerja;
use App\Models\Harian;
use App\Models\Mingguan;
use Illuminate\Http\Request;
use App\Exports\HarianExport;
use App\Exports\MingguanExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KpiExport;
use Barryvdh\DomPDF\Facade\Pdf;



class ExportController extends Controller
{
    // Export to Excel
    public function KPIexportPDF(Request $request, $type)
    {
        // Get filter parameters
        $search = $request->input('search', '');
        $bulan = $request->input('bulan', '');
        $tahun = $request->input('tahun', '');

        // Query the KPI data based on filters
        $kpis = Kpi::when($search, function ($query, $search) {
            $query->whereHas('user', function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%');
            });
        })
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('created_at', $tahun);
            })
            ->get();

        if ($kpis->isEmpty()) {
            return redirect()->route('kpi')->with('message', 'No data found for export.');
        }

        // Calculate the total score
        $totalFinalSkor = $kpis->sum('final_skor');

        // Prepare data for the PDF view
        $data = compact(
            'kpis',
            'totalFinalSkor',
            'search',
            'bulan',
            'tahun',
            'type'
        );

        // Generate the PDF
        $pdf = PDF::loadView('mh.exports.kpi-pdf', $data);
        return $pdf->download('kpi-report.pdf');
    }

    public function exportExcelH(Request $request, $type)
    {
        $project = $request->input('project', 'all');

        // Tentukan status berdasarkan jenis laporan
        $status = $type === 'terima' ? 1 : 2;

        // Tentukan nama file berdasarkan jenis laporan dan project
        $fileName = $project !== 'all' ? "harian-{$type}-{$project}.xlsx" : "harian-{$type}-all.xlsx";

        // Pilih export class berdasarkan tipe
        // $exportClass = $type === 'terima' ? new HarianExportApp($project) : new HarianExportRej($project);

        return Excel::download(new HarianExport($project, $status), $fileName);
    }

    public function exportPDFH(Request $request, $type)
    {
        $project = $request->input('project', 'all');

        // Tentukan status berdasarkan jenis laporan
        $status = $type === 'terima' ? 1 : 2;

        // Ambil data berdasarkan status dan project
        $query = Harian::with('marketing')->where('status', $status);

        if ($project !== 'all') {
            $query->where('project', $project);
        }

        $harianData = $query->get();
        $title = $type === 'terima' ? "Data Diterima" : "Data Ditolak";
        // Pilih view berdasarkan tipe


        $pdf = PDF::loadView('admin.manager.marketing.harian.pdf', compact('harianData', 'title'));

        // Tentukan nama file berdasarkan jenis laporan dan project
        $filename = $project !== 'all' ? "harian-{$type}-{$project}.pdf" : "harian-{$type}-all.pdf";

        return $pdf->download($filename);
    }

    public function exportExcelM(Request $request, $type)
    {
        $projectArea = $request->input('projectArea', 'all');

        $status = $type === 'terima' ? 1 : 2;

        // dd($status);
        $fileName = $projectArea !== 'all' ? "Mingguan-{$type}-{$projectArea}.xlsx" : "Mingguan-{$type}-all.xlsx";

        return Excel::download(new MingguanExport($projectArea, $status), $fileName);
    }

    public function exportPDFM(Request $request, $type)
    {
        $projectArea = $request->input('projectArea', 'all');

        $status = $type === 'terima' ? 1 : 2;

        $query = Mingguan::with('marketing')->where('status', $status);

        if ($projectArea !== 'all') {
            $query->where('projectArea', $projectArea);
        }

        $mingguanData = $query->get();

        $title = $type === 'terima' ? "Data Mingguan Diterima" : "Data Mingguan Ditolak";

        $pdf = PDF::loadView('admin.manager.marketing.mingguan.pdf', compact('mingguanData', 'title'));

        // Tentukan nama file berdasarkan jenis laporan dan projectArea
        $filename = $projectArea !== 'all' ? "mingguan-{$type}-{$projectArea}.pdf" : "mingguan-{$type}-all.pdf";

        return $pdf->download($filename);
    }
}
