@extends('mh.templates.index')

@section('page-mh')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Daftar Kinerja</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('add.kinerja') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Tambah Kinerja
            </a>
        </div>

        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Perilaku</th>
                    <th class="py-2 px-4 border">Nilai</th>
                    {{-- <th class="py-2 px-4 border">Bulan</th>
                    <th class="py-2 px-4 border">Tahun</th> --}}
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kinerja as $k)
                    <tr>
                        <td class="py-2 px-4 border">{{ $k->user->name }}</td>
                        <td class="py-2 px-4 border">{{ $k->perilaku }}</td>
                        <td class="py-2 px-4 border">{{ $k->nilai }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('edit.kinerja', $k->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('delete.kinerja', $k->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
