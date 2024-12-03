@extends('gm.templates.index')

@section('page-kpi')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Edit KPI</h2>
        <form action="{{ route('kpi.update', $kpi->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') <!-- This is where the method becomes PUT -->

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $kpi->nama) }}"
                    class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $kpi->jabatan) }}"
                    class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div>
                <label for="desc" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" id="desc" name="desc" value="{{ old('desc', $kpi->desc) }}"
                    class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="bobot" class="block text-sm font-medium text-gray-700">Weight</label>
                    <input type="number" id="bobot" name="bobot" value="{{ old('bobot', $kpi->bobot) }}"
                        class="mt-1 p-2 w-full border rounded" required>
                </div>
                <div>
                    <label for="target" class="block text-sm font-medium text-gray-700">Target</label>
                    <input type="number" id="target" name="target" value="{{ old('target', $kpi->target) }}"
                        class="mt-1 p-2 w-full border rounded" required readonly>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="realisasi" class="block text-sm font-medium text-gray-700">Realization</label>
                    <input type="number" id="realisasi" name="realisasi" value="{{ old('realisasi', $kpi->realisasi) }}"
                        class="mt-1 p-2 w-full border rounded" required>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update KPI</button>
            </div>
        </form>
    </div>
@endsection
