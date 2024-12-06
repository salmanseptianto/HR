@extends('mh.templates.index')

@section('page-mh')
    <div class="container mx-auto p-4">

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">

            <div class="flex justify-between items-center mb-4">
                <!-- Header Section -->
                <h2 class="text-xl font-bold text-gray-700">KPI Management</h2>

                <!-- Add KPI Button -->
                <div class="flex justify-between items-center">
                    <!-- Button Section -->
                    <a href="{{ url('manager-hrd/kpi') }}"
                        class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md transition duration-200 mr-2">
                        Print KPI
                    </a>
                    <a href="{{ url('manager-hrd/add-kpi') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md transition duration-200 mr-2">
                        Add KPI
                    </a>
                    <a href="{{ url('manager-hrd/add-appraisal') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md transition duration-200">
                        Add Appraisal
                    </a>
                </div>

            </div>
            <!-- Search Form with Additional Filters -->
            <div class="space-y-4">
                <form action="{{ route('kpi') }}" method="GET" class="space-y-4">
                    <div class="flex items-center space-x-4 mb-4">
                        <!-- Name Filter -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700">Nama</label>
                            <select id="search" name="search" class="mt-1 p-2 w-full border rounded">
                                <option value="" selected>Pilih Nama</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->name }}"
                                        {{ request('search') == $user->name ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Month Filter -->
                        <div class="flex-1">
                            <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                            <select id="bulan" name="bulan" class="mt-1 p-2 w-full border rounded">
                                {{-- <option value="" disabled selected>Pilih Bulan</option> --}}
                                <option value="" selected>Pilih Bulan</option>
                                @php
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
                                        'Desember',
                                    ];
                                @endphp

                                @foreach ($months as $index => $month)
                                    <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Year Filter -->
                        <div class="flex-1">
                            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                            <select id="tahun" name="tahun" class="mt-1 p-2 w-full border rounded">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @php
                                    $currentYear = date('Y');
                                    $years = range($currentYear, 2020); // Generates an array from current year to 2020
                                @endphp

                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Button -->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white mt-6 py-2 px-4 rounded">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (!request('search') && !request('bulan'))
            <!-- Pesan awal tanpa pencarian -->
            <div class="p-2 rounded mb-3 text-sm text-center text-gray-600">
                Silahkan, Cari data terlebih dahulu 🔍
            </div>
        @elseif (request('search') && $kpis->count() > 0)
            <!-- Menampilkan data KPI setelah pencarian -->
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="border border-gray-300 p-2">Nama</th>
                        <th class="border border-gray-300 p-2">Jabatan</th>
                        <th class="border border-gray-300 p-2">Desc</th>
                        <th class="border border-gray-300 p-2">Bobot</th>
                        <th class="border border-gray-300 p-2">Target</th>
                        <th class="border border-gray-300 p-2">Realisasi</th>
                        <th class="border border-gray-300 p-2">Skor</th>
                        <th class="border border-gray-300 p-2">Final Skor</th>
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kpis as $kpi)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $kpi->nama }}</td>
                            <td class="border border-gray-300 p-2">{{ $kpi->jabatan }}</td>
                            <td class="border border-gray-300 p-2">{{ \Illuminate\Support\Str::limit($kpi->desc, 30) }}
                            </td>
                            {{-- <td class="border border-gray-300 p-2">{{ $kpi->desc }}</td> --}}
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->bobot, 0, '.', '') }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->target, 0, '.', '') }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->realisasi, 0, '.', '') }}
                            </td>
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->skor, 0, '.', '') }}</td>
                            <td class="border border-gray-300 p-2">{{ $kpi->final_skor }}</td>
                            <td class="border border-gray-300 p-2">
                                <a href="{{ route('kpi.edit', $kpi->id) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('kpi.destroy', $kpi->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-4">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="font-bold">
                    <tr>
                        <td class="border border-gray-300 p-2 text-bold text-center" colspan="3">Total Skor Akhir
                        </td>
                        <td class="border border-gray-300 text-bold text-start pl-2">{{ $totalBobot }}</td>
                        <td class="border border-gray-300 p-2" colspan="3"></td>
                        <td class="border border-gray-300 p-2 text-bold text-start pl-2">{{ $totalFinalSkor }}</td>
                        <td class="border border-gray-300 p-2"></td>
                    </tr>
                </tfoot>
            </table>
        @else
            <!-- Pesan data tidak ditemukan -->
            <div class="bg-red-500 p-2 rounded mb-3 text-sm text-center text-white">
                Maaf, data yang Anda cari tidak ditemukan 🙏
            </div>
        @endif

    </div>
@endsection
