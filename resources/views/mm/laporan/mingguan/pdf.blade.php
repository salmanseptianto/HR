<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Mingguan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0.5in;
            /* Reduced margin for more space */
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 10pt;
            /* Smaller font size */
        }

        table {
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
            padding: 4px;
            /* Reduced padding */
            text-align: left;
            font-size: 9pt;
            /* Smaller font size for table content */
        }

        th {
            background-color: #f2f2f2;
        }

        .py-3 {
            padding-top: 0.5rem;
            /* Adjusted for smaller font */
            padding-bottom: 0.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            /* Adjusted for smaller font */
            padding-right: 1rem;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            /* Reduced margin */
            font-size: 12pt;
            /* Slightly larger font size for the title */
        }
    </style>
</head>

<body>
    <h2>{{ $title }}</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
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
                    <td class="py-3 px-4">{{ $data->periode }}</td>
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
