<?php

namespace App\Exports;

use App\Models\Mingguan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MingguanExport implements FromArray, WithHeadings
{
    protected $projectArea;
    protected $status;

    public function __construct($projectArea = null, $status = null)
    {
        $this->projectArea = $projectArea;
        $this->status = $status;
    }

    public function array(): array
    {
        $query = Mingguan::with('marketing')->where('status', $this->status);

        if ($this->projectArea && $this->projectArea !== 'all') {
            $query->where('projectArea', $this->projectArea);
        }

        $mingguanData = $query->get();

        $exportData = [];
        foreach ($mingguanData as $index => $data) {
            $projectName = '';

            if ($data->projectArea == 'sakinah') {
                $projectName = 'Griya Sakinah 2';
            } elseif ($data->projectArea == 'savill') {
                $projectName = 'Sakinah Village';
            } elseif ($data->projectArea == 'triehans') {
                $projectName = 'Triehans Village';
            }

            $exportData[] = [
                $index + 1, // Nomor
                $data->marketing->name ?? 'Manager Marketing',
                $projectName,
                $data->periode,
                $data->totalJumlahKanva,
                $data->jumlahKanvasTimSeminggu,
                $data->iklanOnline,
                $data->postingSosmed,
                $data->janjiTemuDanKunjungan,
                $data->calonKonsCekLokasi,
                $data->totalDataLeads,
                $data->dataProspek,
                $data->hotProspek,
                $data->booking,
                $data->pemberkasan,
                number_format($data->closingAkadCash, 2, ',', '.'),
                $data->rencanaTargetClosingDalam1Bulan,
            ];
        }

        return $exportData;
    }

    public function headings(): array
    {
        return ['Nomor', 'Nama Marketing', 'Project Area', 'Periode', 'Total Jumlah Kanva', 'Jumlah Kanvas Tim Seminggu', 'Iklan Online', 'Posting Sosmed', 'Janji Temu dan Kunjungan', 'Calon Kons. Cek Lokasi', 'Total Data Leads', 'Data Prospek', 'Hot Prospek', 'Booking', 'Pemberkasan', 'Closing Akad/Cash', 'Rencana Target Closing Dalam 1 Bulan'];
    }
}
