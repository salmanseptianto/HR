@extends('mh.templates.index')

@section('page-mh')
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Tambah Kinerja</h2>

        <form action="{{ route('add.kinerja.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <select id="nama" name="nama" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Pilih Pengguna --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="perilaku" class="block text-sm font-medium text-gray-700">Perilaku</label>
                <select id="perilaku" name="perilaku" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Pilih Perilaku --</option>
                    <option value="Striving for Excellence (Berupaya Meraih Hasil Terbaik)">
                        Striving for Excellence
                        (Berupaya Meraih Hasil Terbaik)
                    </option>
                    <option value="Problem Solving (Kecakapan dalam Memecahkan Masalah)">Problem Solving
                        (Kecakapan dalam Memecahkan Masalah)
                    </option>
                    <option value="Motivasi dan Ketekunan">Motivasi dan Ketekunan</option>
                    <option value="Disiplin Kerja">Disiplin Kerja</option>
                    <option value="Pengetahuan Teknis">Pengetahuan Teknis</option>
                </select>
            </div>

            <div>
                <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai</label>
                <select id="nilai" name="nilai" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Pilih Nilai --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tambah
                Kinerja</button>
            <a href="{{ route('kpi') }}" class="bg-red-500 text-white py-2  px-4 rounded hover:bg-red-600">Selesai</a>
        </form>
    </div>
@endsection
