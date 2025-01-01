@extends('mh.templates.index')

@section('page-mh')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Edit Kinerja</h2>

        <form action="{{ route('update.kinerja', $kinerja->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <select id="nama" name="nama" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled>-- Pilih Pengguna --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $kinerja->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="perilaku" class="block text-sm font-medium text-gray-700">Perilaku</label>
                <select id="perilaku" name="perilaku" class="mt-1 p-2 w-full border rounded" required>
                    <option value="Striving for Excellence"
                        {{ $kinerja->perilaku == 'Striving for Excellence' ? 'selected' : '' }}>
                        Striving for Excellence
                    </option>
                    <option value="Problem Solving" {{ $kinerja->perilaku == 'Problem Solving' ? 'selected' : '' }}>
                        Problem Solving
                    </option>
                    <option value="Motivasi dan Ketekunan"
                        {{ $kinerja->perilaku == 'Motivasi dan Ketekunan' ? 'selected' : '' }}>
                        Motivasi dan Ketekunan
                    </option>
                    <option value="Disiplin Kerja" {{ $kinerja->perilaku == 'Disiplin Kerja' ? 'selected' : '' }}>
                        Disiplin Kerja
                    </option>
                    <option value="Pengetahuan Teknis" {{ $kinerja->perilaku == 'Pengetahuan Teknis' ? 'selected' : '' }}>
                        Pengetahuan Teknis
                    </option>
                </select>
            </div>

            <div>
                <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai</label>
                <select id="nilai" name="nilai" class="mt-1 p-2 w-full border rounded" required>
                    <option value="1" {{ $kinerja->nilai == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ $kinerja->nilai == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ $kinerja->nilai == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ $kinerja->nilai == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{ $kinerja->nilai == 5 ? 'selected' : '' }}>5</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update
                Kinerja</button>
        </form>
    </div>
@endsection
