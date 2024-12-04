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
                <select id="jabatan" name="jabatan" class="mt-1 p-2 w-full border rounded" required @readonly(true)>
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

            {{-- <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="date" name="date" class="mt-1 p-2 w-full border rounded" required>
            </div> --}}

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add KPI</button>
            </div>
        </form>
    </div>

    <!-- JavaScript to dynamically update jabatan based on selected nama -->
    <script>
        document.getElementById('nama').addEventListener('change', function() {
            let selectedUser = this.options[this.selectedIndex];
            let jabatanSelect = document.getElementById('jabatan');
            jabatanSelect.innerHTML = ''; // Clear previous jabatan options

            let jabatanOption = document.createElement('option');
            jabatanOption.value = selectedUser.getAttribute('data-jabatan');
            jabatanOption.textContent = selectedUser.getAttribute('data-jabatan');
            jabatanSelect.appendChild(jabatanOption); // Add the selected user's jabatan
        });
    </script>
@endsection
