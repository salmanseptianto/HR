<!DOCTYPE html>
<html>

<head>
    <title>Laporan KPI dan Kinerja</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        h1,
        h3 {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <h1>Laporan KPI dan Kinerja</h1>

    @if ($search || $bulan || $tahun)
        <p style="text-align: center; margin-bottom: 20px;">
            <strong>Filter:</strong>
            {{ $search ? "Nama: $search" : '' }}
            {{ $bulan ? 'Bulan: ' . \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : '' }}
            {{ $tahun ? "Tahun: $tahun" : '' }}
        </p>
    @endif

    <!-- KPI Table -->
    <h3>Daftar KPI</h3>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Desc</th>
                <th>Bobot</th>
                <th>Target</th>
                <th>Realisasi</th>
                <th>Skor</th>
                <th>Final Skor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kpisQuery as $kpi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kpi->desc }}</td>
                    <td>{{ $kpi->bobot }}</td>
                    <td>{{ $kpi->target }}</td>
                    <td>{{ $kpi->realisasi }}</td>
                    <td>{{ $kpi->skor }}</td>
                    <td>{{ $kpi->final_skor }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><strong>Total</strong></td>
                <td>{{ number_format($totalFinalSkor, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
