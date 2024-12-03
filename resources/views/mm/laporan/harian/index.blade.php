@extends('mm.templates.index')

@section('page-dashboard')
    <div class="container mx-auto px-8 py-6">
        <div class="grid grid-cols-1 gap-8">

            <!-- Data Diterima Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 overflow-x-auto w-full">
                <h1 class="text-3xl font-semibold mb-6 text-blue-800 border-b-4 border-blue-400">{{ $title }}</h1>

                <div class="flex space-x-4">
                    <form action="{{ route('ReportHarian', ['type' => $type]) }}" method="GET" id="filterForm" class="mb-4">
                        <select id="projectDropdown" name="project"
                            class="block w-full border border-gray-300 rounded-lg px-6 py-3 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm"
                            onchange="document.getElementById('filterForm').submit();">
                            @php
                                $projects = [
                                    'all' => 'All Project',
                                    'sakinah' => 'Griya Sakinah 2',
                                    'savill' => 'Sakinah Village',
                                    'triehans' => 'Triehans Village',
                                ];
                            @endphp
                            @foreach ($projects as $value => $label)
                                @php
                                    $encryptedValue = $value === 'all' ? 'all' : Crypt::encrypt($value);
                                    $selected = request('project') === $encryptedValue ? 'selected' : '';
                                @endphp
                                <option value="{{ $encryptedValue }}" {{ $selected }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </form>


                    <!-- Form Export Excel -->
                    <form action="{{ route('harian.export.excel', ['type' => $type === 'approve' ? 'terima' : 'tolak']) }}"
                        method="GET" id="excelExportForm" class="mb-4">
                        <input type="hidden" name="project" id="projectExcel">
                        <button type="submit"
                            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                            Export to Excel
                        </button>
                    </form>

                    <!-- Form Export PDF -->
                    <form action="{{ route('harian.export.pdf', ['type' => $type === 'approve' ? 'terima' : 'tolak']) }}"
                        method="GET" id="pdfExportForm" class="mb-4">
                        <input type="hidden" name="project" id="projectPDF">
                        <button type="submit"
                            class="inline-block px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                            Export to PDF
                        </button>
                    </form>
                </div>


                @if ($harian->isEmpty())
                    <p class="text-gray-600 text-lg">Tidak ada data yang tersedia.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                            <thead class="bg-blue-100 text-blue-800 uppercase text-sm">
                                <tr>
                                    <th class="py-3 px-4 text-left border-b">Nomor</th>
                                    <th class="py-3 px-4 text-left border-b">Nama Akun</th>
                                    <th class="py-3 px-4 text-left border-b">Nama Marketing</th>
                                    <th class="py-3 px-4 text-left border-b">Tanggal</th>
                                    <th class="py-3 px-4 text-left border-b">Project</th>
                                    <th class="py-3 px-4 text-left border-b">Pekerjaan</th>
                                    <th class="py-3 px-4 text-left border-b">Alamat</th>
                                    <th class="py-3 px-4 text-left border-b">Prospek</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @foreach ($harian as $index => $data)
                                    <tr class="border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">{{ $data->marketing->name }}</td>
                                        <td class="py-3 px-4">{{ $data->nama }}</td>
                                        <td class="py-3 px-4">{{ $data->date }}</td>
                                        <td class="py-3 px-4">
                                            @if ($data->project == 'sakinah')
                                                Griya Sakinah 2
                                            @elseif ($data->project == 'savill')
                                                Sakinah Village
                                            @elseif ($data->project == 'triehans')
                                                Triehans Villagee
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">{{ $data->pekerjaan }}</td>
                                        <td class="py-3 px-4">{{ $data->alamat }}</td>
                                        <td class="py-3 px-4">{{ $data->prospek }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <script>
            // Function to update hidden inputs based on selected dropdown value
            function updateHiddenInputs() {
                var selectedProject = document.getElementById('projectDropdown').value;

                // Set nilai project ke dalam input hidden form Excel dan PDF
                document.getElementById('projectExcel').value = selectedProject;
                document.getElementById('projectPDF').value = selectedProject;
            }

            // Update hidden inputs when dropdown value changes
            document.getElementById('projectDropdown').addEventListener('change', updateHiddenInputs);

            // Update hidden inputs before form is submitted
            document.getElementById('excelExportForm').addEventListener('submit', updateHiddenInputs);
            document.getElementById('pdfExportForm').addEventListener('submit', updateHiddenInputs);
        </script>
    @endsection
