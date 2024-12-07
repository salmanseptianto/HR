@extends('mh.templates.index')

@section('page-mh')
    <!-- Button to open the modal -->
    <div class="text-center mb-4">
        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="toggleModal(true)">
            Tampilkan Panduan
        </button>
    </div>

    <!-- Modal (initially hidden) -->
    <div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="bg-white p-4 rounded shadow-lg max-w-full w-full">
            <div class="flex justify-center mb-2">
                <img src="{{ asset('foto/table.png') }}" alt="Performance Appraisal Image" class="max-w-full h-auto">
            </div>
            <!-- Close button -->
            <div class="mt-1 text-right">
                <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="toggleModal(false)">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Add Kinerja</h2>

        <form action="{{ route('add.kinerja') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nama field (user selection) -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <select id="nama" name="nama" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Select User --</option>
                    @foreach ($kpis as $kpi)
                        <option value="{{ $kpi->id }}">{{ $kpi->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Kopetensi / Perilaku field -->
            <div>
                <label for="perilaku" class="block text-sm font-medium text-gray-700">Kopetensi / Perilaku</label>
                <select id="perilaku" name="perilaku" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Select Perilaku --</option>
                    <option value="Striving for Excellence (Berupaya Meraih Hasil Terbaik)">Striving for Excellence
                        (Berupaya Meraih Hasil Terbaik)</option>
                    <option value="Problem Solving (Kecakapan dalam Memecahkan Masalah)">Problem Solving (Kecakapan dalam
                        Memecahkan Masalah)</option>
                    <option value="Motivasi dan Ketekunan dalam Kerja">Motivasi dan Ketekunan dalam Kerja</option>
                    <option value="Disiplin Kerja">Disiplin Kerja</option>
                    <option value="Pengetahuan Teknis (Skills dan Knowledge)">Pengetahuan Teknis (Skills dan Knowledge)
                    </option>
                </select>
            </div>

            <!-- Nilai (rating) dropdown -->
            <div>
                <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai</label>
                <select id="nilai" name="nilai" class="mt-1 p-2 w-full border rounded" required>
                    <option value="" disabled selected>-- Select Nilai --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <!-- Month and Year dropdown fields -->
            <div class="grid grid-cols-2 gap-4">
                <div class="w-full">
                    <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="month" name="month" class="mt-1 p-2 w-full border rounded" required>
                        <option value="" disabled selected>Pilih Bulan</option>
                        @php
                            $months = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember',
                            ];
                        @endphp
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full">
                    <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select id="year" name="year" class="mt-1 p-2 w-full border rounded" required>
                        <option value="" disabled selected>Pilih Tahun</option>
                        @for ($i = now()->year; $i >= now()->year - 10; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add KPI</button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Modal toggle -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden', !show);
        }
    </script>
@endsection
