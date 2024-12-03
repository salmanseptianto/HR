@extends('mh.templates.index')

@section('page-kpi')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Add New KPI</h2>
        <form action="{{ route('add') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div>
                <label for="desc" class="block text-sm font-medium text-gray-700">KPI</label>
                <input type="text" id="desc" name="desc" class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="bobot" class="block text-sm font-medium text-gray-700">Bobot</label>
                    <input type="number" id="bobot" name="bobot" class="mt-1 p-2 w-full border rounded" required>
                </div>
                <div>
                    <label for="target" class="block text-sm font-medium text-gray-700">Target</label>
                    <input value="100" type="number" id="target" name="target" class="mt-1 p-2 w-full border rounded" required readonly>
                </div>
            </div>

            <div>
                <label for="realisasi" class="block text-sm font-medium text-gray-700">Realisasi akhir bulan %</label>
                <input type="number" id="realisasi" name="realisasi" class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add KPI</button>
            </div>
        </form>
    </div>
@endsection
