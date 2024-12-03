@extends('mm.templates.index')

@section('page-dashboard')
    <div class="container mx-auto px-8 py-6">
        <div class="grid grid-cols-1 gap-8">

            <!-- Data Harian Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 overflow-x-auto w-full">
                <h2 class="text-3xl font-semibold mb-6 text-blue-800 border-b-4 border-blue-400 pb-2">Data Harian {{$title}}</h2>

                <div class="flex space-x-4 mb-4">

                    @if ($mingguanData->isEmpty())
                        <p class="text-gray-600 text-lg">Tidak ada data yang tersedia.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                                    <tr>
                                        @foreach (['No.', 'Nama', 'Project', 'Periode', 'kanvas/flyer 1 minggu', 'Kanvas Tim seminggu', 'Iklan', 'posting', 'Janji', 'Calon Konsumen', 'Total data Lead', 'Prospek', 'Hot Prospek', 'Booking', 'Pemberkasan', 'Closing', 'Target Closing 1 Bln', 'Actions'] as $header)
                                            <th class="py-3 px-4 text-left border-b">{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-sm divide-y divide-gray-300">
                                    @foreach ($mingguanData as $index => $data)
                                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                                            <td class="py-3 px-4">{{ strtok($data->marketing->name, ' ') }}</td>
                                            <td class="py-3 px-4">{{ strtok($data->projectArea, ' ') }}</td>
                                            <td class="py-3 px-4">{{ $data->periode }}</td>
                                            <td class="py-3 px-4">{{ $data->totalJumlahKanva }}</td>
                                            <td class="py-3 px-4">{{ $data->jumlahKanvasTimSeminggu }}</td>
                                            <td class="py-3 px-4">{{ $data->iklanOnline }}</td>
                                            <td class="py-3 px-4">{{ $data->postingSosmed }}</td>
                                            <td class="py-3 px-4">{{ $data->janjiTemuDanKunjungan }}</td>
                                            <td class="py-3 px-4">{{ $data->calonKonsCekLokasi }}</td>
                                            <td class="py-3 px-4">{{ $data->totalDataLeads }}</td>
                                            <td class="py-3 px-4">{{ $data->dataProspek }}</td>
                                            <td class="py-3 px-4">{{ $data->hotProspek }}</td>
                                            <td class="py-3 px-4">{{ $data->booking }}</td>
                                            <td class="py-3 px-4">{{ $data->pemberkasan }}</td>
                                            <td class="py-3 px-4">Rp.
                                                {{ number_format($data->closingAkadCash, 0, ',', '.') }}</td>
                                            <td class="py-3 px-4">{{ $data->rencanaTargetClosingDalam1Bulan }}</td>
                                            <td class="py-3 px-4 flex space-x-1">
                                                <form
                                                    action="{{ route('mingguan.approve', ['id' => Crypt::encrypt($data->id)]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        class="px-2 py-1 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">Setuju</button>
                                                </form>
                                                <form
                                                    action="{{ route('mingguan.reject', ['id' => Crypt::encrypt($data->id)]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        class="px-2 py-1 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">Tolak</button>
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
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateHiddenInputs() {
                    var selectedProject = document.getElementById('projectDropdown') ? document.getElementById(
                        'projectDropdown').value : '';
                    document.getElementById('projectExcel').value = selectedProject;
                    document.getElementById('projectPDF').value = selectedProject;
                }

                document.getElementById('projectDropdown')?.addEventListener('change', updateHiddenInputs);
                document.getElementById('excelExportForm').addEventListener('submit', updateHiddenInputs);
                document.getElementById('pdfExportForm').addEventListener('submit', updateHiddenInputs);
            });
        </script>
    @endsection
