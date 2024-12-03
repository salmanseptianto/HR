<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Mingguan</title>
    <style>
        @page {
            size: A3 landscape;
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        table {
            margin-right: 2rem;
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .py-3 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .px-4 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    </style>
</head>

<body>
    <h2>{{ $title }}</h2>

    <table>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama Marketing</th>
                <th>Project Area</th>
                <th>Periode</th>
                <th>Total Jumlah Kanva</th>
                <th>Jumlah Kanvas Tim Seminggu</th>
                <th>Iklan Online</th>
                <th>Posting Sosmed</th>
                <th>Janji Temu Dan Kunjungan</th>
                <th>Calon Kons Cek Lokasi</th>
                <th>Total Data Leads</th>
                <th>Data Prospek</th>
                <th>Hot Prospek</th>
                <th>Booking</th>
                <th>Pemberkasan</th>
                <th>Closing Akad Cash</th>
                <th>Rencana Target Closing Dalam 1 Bulan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mingguanData as $index => $data)
                <tr>
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    <td class="py-3 px-4">{{ $data->marketing->name ?? 'Marketing tidak ditemukan' }}</td>
                    <td class="py-3 px-4">{{ $data->projectArea }}</td>
                    @if ($data->projectArea == 'sakinah')
                        Griya Sakinah 2
                    @elseif ($data->projectArea == 'savill')
                        Sakinah Village
                    @elseif ($data->projectArea == 'triehans')
                        Triehans Villagee
                    @endif
                    <td class="py-3 px-4">{{ $data->totalJumlahKanva }}</td>
                    <td class="py-3 px-4">{{ $data->jumlahKanvasTimSeminggu }}</td>
                    <td class="py-3 px-4">{{ $data->iklanOnline }}</td>
                    <td class="py-3 px-4">{{ $data->postingSosmed }}</td>
                    <td class="py-3 px-4">{{ $data->janjiTemuDanKunjungan }}</td>
                    <td class="py-3 px-4">{{ $data->calonKonsCekLokasi }}</td>
                    <td class="py-3 px-4">{{ $data->totalDataLeads }}</td>
                    <td class="py-3 px-4">{{ $data->dataProspek }}</td>
                    <td class="py-3 px-4">{{ $data->hotProspek }}</td>
                    <td class="py-3 px-4">{{ $data->booking }}</td>
                    <td class="py-3 px-4">{{ $data->pemberkasan }}</td>
                    <td class="py-3 px-4">{{ number_format($data->closingAkadCash, 2, ',', '.') }}</td>
                    <td class="py-3 px-4">{{ $data->rencanaTargetClosingDalam1Bulan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
