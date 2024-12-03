@extends('marketing.templates.index')

@section('page-dashboard')
    <div class="grid grid-cols-1 gap-8">
        <!-- Form Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Tambah Data Harian</h2>

            <form method="POST" action="{{ route('addharian') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="project" class="block text-sm font-medium text-gray-700">Project</label>
                    <select id="project" name="project" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                        <option value="" disabled selected> --- PILIH LOKASI PROJECT ----</option>
                        <option value="sakinah">Sakinah 2</option>
                        <option value="savill">Savill</option>
                        <option value="triehans">Triehans</option>
                    </select>
                </div>

                <div>
                    <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="prospek" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="prospek" name="prospek" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                        <option value="" disabled selected> --- PILIH STATUS ----</option>
                        <option value="Prospek">Prospek</option>
                        <option value="Non Prospek">Non-Prospek</option>
                    </select>
                </div>

                <button type="submit"
                    class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Kirim
                </button>
            </form>
        </div>

        <!-- Data Table Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Data Harian</h1>

            @if ($harianData->isEmpty())
                <p class="text-gray-500">Tidak ada data yang tersedia.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100 text-gray-800 uppercase text-sm">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Lengkap</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Project</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pekerjaan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            @foreach ($harianData as $index => $data)
                                <tr>
                                    <td class="px-4 py-4">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">{{ $data->date }}</td>
                                    <td class="px-4 py-4">{{ $data->nama }}</td>
                                    <td class="px-4 py-4">{{ $data->project }}</td>
                                    <td class="px-4 py-4">{{ $data->pekerjaan }}</td>
                                    <td class="px-4 py-4">{{ $data->alamat }}</td>
                                    <td class="px-4 py-4">{{ $data->prospek }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <a href="{{ route('harian.edit', ['id' => Crypt::encrypt($data->id)]) }}"
                                            class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-600 transition duration-300">Edit</a>
                                        <form
                                            action="{{ route('harian.destroy', ['id' => Crypt::encrypt($data->id)]) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var notification = document.getElementById('notification');
            if (notification) {
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 15100); // 15100 milliseconds = 15.1 seconds
            }
        });
    </script>
@endsection
