<?php

namespace App\Exports;

use App\Models\Harian;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HarianExport implements FromArray, WithHeadings
{
    protected $project;
    protected $status;

    public function __construct($project = null, $status = null)
    {
        $this->project = $project;
        $this->status = $status;
    }

    public function array(): array
    {
        // dd($this->status);
        $query = Harian::with('marketing')->where('status', $this->status);

        if ($this->project && $this->project !== 'all') {
            $query->where('project', $this->project);
        }

        $harianData = $query->get();

        $exportData = [];
        foreach ($harianData as $index => $data) {
            $projectName = '';

            if ($data->project == 'sakinah') {
                $projectName = 'Griya Sakinah 2';
            } elseif ($data->project == 'savill') {
                $projectName = 'Sakinah Village';
            } elseif ($data->project == 'triehans') {
                $projectName = 'Triehans Village';
            }

            $exportData[] = [$index + 1, $data->nama, $data->date, $projectName, $data->pekerjaan, $data->alamat, $data->prospek];
        }

        return $exportData;
    }

    public function headings(): array
    {
        return ['Nomor', 'Nama Marketing', 'Tanggal', 'Project', 'Pekerjaan', 'Alamat', 'Prospek'];
    }
}
