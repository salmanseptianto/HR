@extends('marketing.templates.index')

@section('page-dashboard')
    <div class="container mx-auto px-4 py-6">
        <!-- Edit Data Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Edit Data Harian</h2>

            <form action="{{ route('harian.update', ['id' => Crypt::encrypt($harian->id)]) }}" method="POST"  enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Project -->
                <div class="flex flex-col mb-4">
                    <label for="project" class="text-lg font-medium mb-1">Project</label>
                    <select id="project" name="project" class="form-select border border-gray-300 rounded-lg p-2" required>
                        <option value="" disabled>PILIH LOKASI PROJECT</option>
                        <option value="sakinah" {{ $harian->project == 'sakinah' ? 'selected' : '' }}>Sakinah 2</option>
                        <option value="savill" {{ $harian->project == 'savill' ? 'selected' : '' }}>Savill</option>
                        <option value="triehans" {{ $harian->project == 'triehans' ? 'selected' : '' }}>Triehans</option>
                    </select>
                </div>

                <!-- Nama -->
                <div class="flex flex-col mb-4">
                    <label for="nama" class="text-lg font-medium mb-1">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ $harian->nama }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- Pekerjaan -->
                <div class="flex flex-col mb-4">
                    <label for="pekerjaan" class="text-lg font-medium mb-1">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" value="{{ $harian->pekerjaan }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- Alamat -->
                <div class="flex flex-col mb-4">
                    <label for="alamat" class="text-lg font-medium mb-1">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $harian->alamat }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- Prospek -->
                <div class="flex flex-col mb-4">
                    <label for="prospek" class="text-lg font-medium mb-1">Prospek</label>
                    <select id="prospek" name="prospek" class="form-select border border-gray-300 rounded-lg p-2"
                        required>
                        <option value="prospek" {{ $harian->prospek == 'prospek' ? 'selected' : '' }}>Prospek</option>
                        <option value="nonprospek" {{ $harian->prospek == 'nonprospek' ? 'selected' : '' }}>Nonprospek
                        </option>
                    </select>
                </div>

                <!-- Foto -->
                {{-- <div class="flex flex-col mb-4">
                    <label for="foto" class="text-lg font-medium mb-1">Foto</label>
                    <input type="file" id="foto" name="foto"
                        class="form-input border border-gray-300 rounded-lg p-2">
                    @if ($harian->foto)
                        <img src="{{ asset('storage/' . $harian->foto) }}" alt="Current Photo"
                            class="mt-2 w-32 h-32 object-cover">
                    @endif
                </div> --}}

                <!-- Buttons -->
                <div class="flex space-x-4">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Update
                    </button>
                    <a href="{{ route('harian') }}"
                        class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
