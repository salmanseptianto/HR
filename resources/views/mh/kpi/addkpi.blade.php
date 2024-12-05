@extends('mh.templates.index')

@section('page-mh')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Add KPI</h2>
        <form action="{{ route('add') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nama field (user selection) -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <select id="nama" name="nama" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->name }}" data-jabatan="{{ $user->jabatan }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jabatan field (position related to selected user) -->
            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <select id="jabatan" name="jabatan" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Select Jabatan --</option>
                </select>
            </div>

            <!-- KPI description -->
            <div>
                <label for="desc" class="block text-sm font-medium text-gray-700">KPI</label>
                <input type="text" id="desc" name="desc" class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- Bobot field -->
                <div>
                    <label for="bobot" class="block text-sm font-medium text-gray-700">Bobot</label>
                    <input type="number" id="bobot" name="bobot" class="mt-1 p-2 w-full border rounded" required>
                </div>
                <!-- Target field (readonly) -->
                <div>
                    <label for="target" class="block text-sm font-medium text-gray-700">Target</label>
                    <input value="100" type="number" id="target" name="target"
                        class="mt-1 p-2 w-full border rounded" required readonly>
                </div>
            </div>

            <!-- Realisasi field -->
            <div>
                <label for="realisasi" class="block text-sm font-medium text-gray-700">Realisasi akhir bulan %</label>
                <input type="number" id="realisasi" name="realisasi" class="mt-1 p-2 w-full border rounded" required>
            </div>

            <div class="mb-4 flex items-center space-x-4">
                <!-- Month Dropdown -->
                <div>
                    <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="month" name="month" class="mt-1 p-2 w-full border rounded" required>
                        <option value="" disabled selected>Pilih Bulan</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>

                <!-- Year Input -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select id="year" name="year" class="mt-1 p-2 w-full border rounded" required>
                        <option value="" disabled selected>Pilih Tahun</option>
                        @php
                            $currentYear = date('Y');
                            $years = range($currentYear, 2020); // Generates an array from current year to 1900
                        @endphp

                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add KPI</button>
            </div>
        </form>
    </div>

    <!-- JavaScript to dynamically update jabatan based on selected nama -->
    <script>
        document.getElementById('nama').addEventListener('change', function() {
            const selectedUser = this.options[this.selectedIndex];
            const jabatanSelect = document.getElementById('jabatan');

            // Clear previous jabatan options
            jabatanSelect.innerHTML = '';

            // Add new option
            const jabatanOption = document.createElement('option');
            jabatanOption.value = selectedUser.getAttribute('data-jabatan');
            jabatanOption.textContent = selectedUser.getAttribute('data-jabatan');
            jabatanOption.selected = true;
            jabatanSelect.appendChild(jabatanOption);
        });
    </script>
@endsection
