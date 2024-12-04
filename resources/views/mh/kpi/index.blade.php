@extends('mh.templates.index')

@section('page-mh')
    <div class="container mx-auto p-4">

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="space-y-6">
            <!-- Add New KPI Button -->
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">KPI Management</h2>
                <a href="{{ url('manager-hrd/add-kpi') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md transition duration-200">
                    Add New KPI
                </a>
            </div>

            <!-- Search Form with Additional Filters -->
            <div class="space-y-4">
                <form action="{{ route('kpi') }}" method="GET" class="flex items-center space-x-4 mb-4">
                    <!-- Search by Name or Position -->
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="p-2 w-full border rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search by name or position">

                    <!-- Search by Position -->
                    <input type="text" name="search_jabatan" value="{{ request('search_jabatan') }}"
                        class="p-2 w-full border rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search by position">

                    <!-- Search by Date -->
                    <input type="date" name="search_tanggal" value="{{ request('search_tanggal') }}"
                        class="p-2 w-full border rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search by date">

                    <!-- Search Button -->
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Search
                    </button>
                </form>
            </div>
        </div>

        @if ($kpis->count() > 0)
            <!-- Displaying KPIs after search -->
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
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
                            <td class="border border-gray-300 p-2">{{ \Illuminate\Support\Str::limit($kpi->desc, 30) }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->bobot, 0, '.', '') }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->target, 0, '.', '') }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($kpi->realisasi, 0, '.', '') }}</td>
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
            </table>
        @else
            <p class="text-gray-700">No KPIs found based on your search criteria.</p>
        @endif

    </div>
@endsection
