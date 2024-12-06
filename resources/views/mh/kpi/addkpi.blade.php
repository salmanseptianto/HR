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

            <!-- Jabatan field -->
            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <select id="jabatan" name="jabatan" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Select Jabatan --</option>
                </select>
            </div>

            <!-- KPI description (selectable or custom input) -->
            <div>
                <label for="desc" class="block text-sm font-medium text-gray-700">Pilih Deskripsi</label>
                <div id="desc-container" class="relative">
                    <select id="desc" name="desc" class="mt-1 p-2 w-full border rounded">
                        <option value="" disabled selected>-- Pilih Deskripsi --</option>
                    </select>

                    <!-- Custom Description Input (Initially Hidden) -->
                    <div id="customDescContainer" class="mt-2 w-full">
                        <label for="customDesc" class="block text-sm font-medium text-gray-700">Tambah Deskripsi</label>
                        <input id="customDesc" name="desc" type="text" placeholder="Masukkan Deskripsi"
                            class="mt-1 p-2 w-full border rounded">
                    </div>
                </div>
            </div>

            <!-- Bobot and Target fields -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="bobot" class="block text-sm font-medium text-gray-700">Bobot</label>
                    <input id="bobot" name="bobot" class="mt-1 p-2 w-full border rounded" required>
                </div>
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

            <!-- Month and Year -->
            <div class="mb-4 flex items-center space-x-4">
                <div>
                    <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="month" name="month" class="mt-1 p-2 w-full border rounded" required>
                        <option value="" disabled selected>Pilih Bulan</option>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select id="year" name="year" class="mt-1 p-2 w-full border rounded" required>
                        <option value="" disabled selected>Pilih Tahun</option>
                        @php
                            $currentYear = date('Y');
                            $years = range($currentYear, $currentYear - 5);
                        @endphp
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add KPI</button>
            </div>
        </form>
    </div>

    <script>
        const namaSelect = document.getElementById('nama');
        const jabatanSelect = document.getElementById('jabatan');
        const descSelect = document.getElementById('desc');
        const customDescInput = document.getElementById('customDesc');
        const customDescContainer = document.getElementById('customDescContainer');
        const bobotInput = document.getElementById('bobot');

        // Update jabatan when selecting a user
        namaSelect.addEventListener('change', function() {
            const selectedUser = this.options[this.selectedIndex];
            const jabatan = selectedUser.getAttribute('data-jabatan');

            // Reset and populate the Jabatan dropdown
            jabatanSelect.innerHTML = `<option value="${jabatan}" selected>${jabatan}</option>`;

            // Fetch KPIs dynamically based on selected jabatan
            fetch(`/manager-hrd/kpi-by-jabatan?jabatan=${jabatan}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the description select options
                    descSelect.innerHTML = '<option value="" disabled selected>-- Pilih Deskripsi --</option>';
                    data.forEach(kpi => {
                        const option = document.createElement('option');
                        option.value = kpi.desc;
                        option.textContent = kpi.desc;
                        option.setAttribute('data-bobot', kpi.bobot);
                        descSelect.appendChild(option);
                    });

                    // Always show the custom description input
                    customDescContainer.classList.remove('hidden');
                });
        });

        // Update bobot when selecting desc
        descSelect.addEventListener('change', function() {
            const selectedDesc = this.options[this.selectedIndex];
            bobotInput.value = selectedDesc.getAttribute('data-bobot') || '';
        });

        // If custom description is entered, set its value as desc
        customDescInput.addEventListener('input', function() {
            if (this.value) {
                descSelect.value = ''; // Reset select if custom desc is typed
            }
        });
    </script>
@endsection
