@extends('mm.templates.index')

@section('page-dashboard')
    <div class="container mt-4">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Data Harian {{$title}}</h2>

        @if ($harianData->isEmpty())
            <p class="text-gray-500">Tidak ada data yang tersedia.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="py-3 px-6 text-left">Nomor</th>
                            <th class="py-3 px-6 text-left">Nama Marketing</th>
                            <th class="py-3 px-6 text-left">Tanggal</th>
                            <th class="py-3 px-6 text-left">Project</th>
                            <th class="py-3 px-6 text-left">pekerjaan</th>
                            <th class="py-3 px-6 text-left">alamat</th>
                            <th class="py-3 px-6 text-left">status</th>
                            <th class="py-3 px-6 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @foreach ($harianData as $index => $data)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="py-4 px-6 border-b">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 border-b">{{ $data->marketing->name }}</td>
                                <td class="py-4 px-6 border-b">{{ $data->date }}</td>
                                <td class="py-4 px-6 border-b">{{ $data->project }}</td>
                                <td class="py-4 px-6 border-b">{{ $data->pekerjaan }}</td>
                                <td class="py-4 px-6 border-b">{{ $data->alamat }}</td>
                                <td class="py-4 px-6 border-b">{{ $data->prospek }}</td>
                                <td class="py-4 px-6 border-b flex space-x-2">
                                    <form action="{{ route('harian.approve', ['id' => Crypt::encrypt($data->id)]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                                            Setuju
                                        </button>
                                    </form>
                                    <form action="{{ route('harian.reject', ['id' => Crypt::encrypt($data->id)]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                                            Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        // JavaScript to handle notification visibility
        document.addEventListener('DOMContentLoaded', function() {
            var notification = document.getElementById('notification');
            if (notification) {
                // Hide the notification after 15 seconds
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 15100); // 15.1 seconds
            }
        });
    </script>
@endsection
