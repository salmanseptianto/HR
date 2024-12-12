@extends('mh.templates.index')

@section('page-mh')
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif
    <div class="container mx-auto p-6 text-black shadow-md rounded-md bg-white">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">KPI dan Kinerja</h2>
            <div class="flex space-x-3">
                <!-- Pass 'pdf' as the 'type' parameter -->
                <a href="{{ route('kpi.export.pdf', ['type' => 'pdf', 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                    class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-md">Export PDF</a>
                <a href="{{ url('manager-hrd/add-kpi') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Add KPI</a>

                <a href="{{ url('manager-hrd/add-kinerja') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Add Kinerja</a>
            </div>

        </div>


        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters Section -->
        <div class="p-4 mb-6 rounded-md border bg-gray-100">
            <form action="{{ route('kpi') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium">Nama</label>
                        <select id="search" name="search" class="mt-1 p-2 w-full border rounded">
                            <option value="" selected>Pilih Nama</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->name }}"
                                    {{ request('search') == $user->name ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="bulan" class="block text-sm font-medium">Bulan</label>
                        <select id="bulan" name="bulan" class="mt-1 p-2 w-full border rounded">
                            <option value="" selected>Pilih Bulan</option>
                            @foreach ($months as $index => $month)
                                <option value="{{ $index + 1 }}" {{ request('bulan') == $index + 1 ? 'selected' : '' }}>
                                    {{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tahun" class="block text-sm font-medium">Tahun</label>
                        <select id="tahun" name="tahun" class="mt-1 p-2 w-full border rounded">
                            <option value="" selected>Pilih Tahun</option>
                            @for ($year = now()->year; $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="mt-6 bg-gray-700 hover:bg-gray-800 py-2 px-4 text-white rounded-md w-full md:w-auto">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- KPI Section -->
        @if (request('search') || request('bulan') || request('tahun'))
            @if ($kpis->isNotEmpty())
                <div class="p-4 mb-4 rounded-md border bg-gray-100">
                    <p><strong>Nama:</strong> {{ $kpis->first()->nama }}</p>
                    <p><strong>Jabatan:</strong> {{ $kpis->first()->jabatan }}</p>
                </div>
            @endif
            <h3 class="text-lg font-semibold mb-4">Daftar KPI</h3>
            <table class="table-auto w-full border border-gray-400">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-1 px-2 border w-12">No.</th>
                        <th class="py-2 px-4 border">Desc</th>
                        <th class="py-2 px-4 border">Bobot</th>
                        <th class="py-2 px-4 border">Target</th>
                        <th class="py-2 px-4 border">Realisasi</th>
                        <th class="py-2 px-4 border">Skor</th>
                        <th class="py-2 px-4 border">Final Skor</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kpis as $kpi)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $kpi->desc }}</td>
                            <td class="py-2 px-4 border text-center">{{ number_format($kpi->bobot, 0, '.', '') }}</td>
                            <td class="py-2 px-4 border text-center">{{ number_format($kpi->target, 0, '.', '') }}</td>
                            <td class="py-2 px-4 border text-center">{{ number_format($kpi->realisasi, 0, '.', '') }}</td>
                            <td class="py-2 px-4 border text-center">{{ number_format($kpi->skor, 0, '.', '') }}</td>
                            <td class="py-2 px-4 border text-center">{{ $kpi->final_skor }}</td>
                            <td class="py-2 px-4 border text-center w-32">
                                <a href="{{ route('kpi.edit', $kpi->id) }}" class="text-blue-500">Edit</a> |
                                <form action="{{ route('kpi.destroy', $kpi->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-gray-500">Data tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-200">
                        <td colspan="6" class="py-2 px-4 font-bold">Total</td>
                        <td class="py-2 px-4">{{ $totalFinalSkor }}</td>
                        <td class="border"></td>
                    </tr>
                </tfoot>
            </table>
        @endif

        <!-- Kinerja Section -->
        @if (request('search') || request('bulan') || request('tahun'))
            <h3 class="text-lg font-semibold mb-4 mt-3">Daftar Kinerja</h3>
            <table class="table-auto w-full border border-gray-400">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-1 px-2 border w-12">No.</th>
                        <th class="py-2 px-4 border">Perilaku</th>
                        <th class="py-2 px-4 border w-28 ">Nilai</th>
                        <th class="py-2 px-4 border w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kinerja as $k)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $k->perilaku }}</td>
                            <td class="py-2 px-4 border text-center">{{ $k->nilai }}</td>
                            <td class="py-2 px-4 border text-center">
                                <a href="{{ route('edit.kinerja', $k->id) }}"
                                    class="text-indigo-400 hover:text-indigo-200">Edit</a> |
                                <form action="{{ route('delete.kinerja', $k->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">Data tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-200">
                        <td colspan="2" class="py-2 px-4 font-bold">Total</td>
                        <td class="py-2 px-4">{{ $totalNilai }}</td>
                        <td class="border"></td>
                    </tr>
                </tfoot>
            </table>
        @endif

        <!-- Total KPI dan Kinerja Section -->
        @if (request('search') || request('bulan') || request('tahun'))
            <h3 class="text-lg font-semibold mb-4 mt-3">Total KPI dan Kinerja</h3>
            @php
                $hasilAkhir = ($totalFinalSkor + $totalNilai) / 2;
                $kategori = match (true) {
                    $hasilAkhir <= 40 => 'Kurang',
                    $hasilAkhir <= 60 => 'Cukup',
                    $hasilAkhir <= 90 => 'Baik',
                    default => 'Sangat Baik',
                };
            @endphp
            <table class="table-auto w-full border border-gray-400">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-1 px-2 border w-12">No.</th>
                        <th class="py-2 px-4 border">Nilai KPI</th>
                        <th class="py-2 px-4 border">Nilai Kinerja</th>
                        <th class="py-2 px-4 border">Hasil Akhir</th>
                        <th class="py-2 px-4 border">Kategori Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border text-center">1</td>
                        <td class="py-2 px-4 border text-center">{{ number_format($totalFinalSkor, 2) }}</td>
                        <td class="py-2 px-4 border text-center">{{ number_format($totalNilai, 2) }}</td>
                        <td class="py-2 px-4 border text-center">{{ number_format($hasilAkhir, 2) }}</td>
                        <td class="py-2 px-4 border text-center">{{ $kategori }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <div class=" p-2 rounded mb-3 text-sm text-center text-black">
                Mohon Maaf, Harap cari data terlebih dahulu 🙏
            </div>
        @endif
    </div>
@endsection
