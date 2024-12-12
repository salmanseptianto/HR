<?php

namespace App\Exports;

use App\Models\Kpi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KpiExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $bulan;
    protected $tahun;

    public function __construct($search = null, $bulan = null, $tahun = null)
    {
        $this->search = $search;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        // Build query based on filters
        $query = Kpi::query();

        if ($this->search) {
            $query->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->bulan) {
            $query->whereMonth('created_at', $this->bulan);
        }

        if ($this->tahun) {
            $query->whereYear('created_at', $this->tahun);
        }

        return $query->get(['nama', 'jabatan', 'desc', 'bobot', 'target', 'realisasi', 'skor', 'final_skor']);
    }

    public function headings(): array
    {
        return ['Nama', 'Jabatan', 'Desc', 'Bobot', 'Target', 'Realisasi', 'Skor', 'Final Skor'];
    }
}
