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
            <div class="space-y-6">
                <!-- Deskripsi KPI -->
                <div>
                    <label for="desc" class="block text-sm font-medium text-gray-700">Pilih Deskripsi</label>
                    <div id="desc-container" class="relative mt-1">
                        <select id="desc" name="desc"
                            class="block w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>-- Pilih Deskripsi --</option>
                        </select>
                    </div>
                </div>

                <!-- Custom Deskripsi dan Bobot -->
                <div id="customDescContainer" class="hidden space-y-4">
                    <div>
                        <label for="customDesc" class="block text-sm font-medium text-gray-700">Tambah Deskripsi</label>
                        <input id="customDesc" name="desc" type="text" placeholder="Masukkan Deskripsi"
                            class="block w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Bobot dan Target -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Bobot -->
                    <div>
                        <label for="bobot" class="block text-sm font-medium text-gray-700">Bobot</label>
                        <input id="bobot" name="bobot" type="text"
                            class="block w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <!-- Target -->
                    <div>
                        <label for="target" class="block text-sm font-medium text-gray-700">Target</label>
                        <input id="target" name="target" type="number" value="100"
                            class="block w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            readonly>
                    </div>
                </div>
            </div>

            <!-- Realisasi field -->
            <div>
                <label for="realisasi" class="block text-sm font-medium text-gray-700">Realisasi akhir bulan %</label>
                <input type="number" id="realisasi" name="realisasi" class="mt-1 p-2 w-full border rounded" required>
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
        const selectedDesc = document.getElementById('desc');
        const customDescInput = document.getElementById('customDesc');
        const customDescContainer = document.getElementById('customDescContainer');
        const bobotInput = document.getElementById('bobot');

        // Update jabatan when selecting a user
        namaSelect.addEventListener('change', function() {
            const selectedUser = this.options[this.selectedIndex];
            const jabatan = selectedUser.getAttribute('data-jabatan');

            // Reset and populate the Jabatan dropdown
            jabatanSelect.innerHTML = `<option value="${jabatan}" selected>${jabatan}</option>`;

            // Fetch KPIs dynamically based on selected jabatan and desc
            fetch(`/manager-hrd/kpi-by-jabatan?jabatan=${jabatan}&desc=${selectedDesc.value}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the description select options
                    selectedDesc.innerHTML =
                        '<option value="" disabled selected>-- Pilih Deskripsi --</option>';
                    data.forEach(kpi => {
                        // Check if the option already exists in the dropdown
                        const existingOption = Array.from(selectedDesc.options).find(option => option
                            .value === kpi.desc);
                        if (!existingOption) {
                            const option = document.createElement('option');
                            option.value = kpi.desc;
                            option.textContent = kpi.desc;
                            option.setAttribute('data-bobot', kpi.bobot);
                            selectedDesc.appendChild(option);
                        }
                    });

                    // Always show the custom description input
                    customDescContainer.classList.remove('hidden');
                });
        });

        // Update bobot when selecting desc
        selectedDesc.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            bobotInput.value = selectedOption.getAttribute('data-bobot') || ''; // Set bobot based on desc
        });

        // If custom description is entered, set its value as desc
        customDescInput.addEventListener('input', function() {
            if (this.value) {
                selectedDesc.value = ''; // Reset select if custom desc is typed
            }
        });
    </script>
@endsection
