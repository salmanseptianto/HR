@extends('marketing.templates.index')

@section('page-dashboard')
    <div class="grid grid-cols-1 gap-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Add Mingguan Data</h2>
            <form action="{{ route('addmingguan') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="projectArea" class="block text-sm font-medium text-gray-700">Project</label>
                    <select id="projectArea" name="projectArea" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                        <option value="" disabled selected> --- PILIH LOKASI PROJECT ----</option>
                        <option value="Griya Sakinah 2">Griya Sakinah 2</option>
                        <option value="Sakinah Village">Sakinah Village</option>
                        <option value="Triehans Village">Triehans Village</option>
                    </select>
                </div>

                <div>
                    <label for="periode" class="block text-sm font-medium text-gray-700">Periode</label>
                    <input type="date" id="periode" name="periode" required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="totalJumlahKanva" class="block text-sm font-medium text-gray-700">Total Jumlah Kanva</label>
                    <input type="text" id="totalJumlahKanva" name="totalJumlahKanva"
                        placeholder='Masukan Total Jumlah Kanva Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="jumlahKanvasTimSeminggu" class="block text-sm font-medium text-gray-700">Jumlah Kanvas Tim
                        Seminggu</label>
                    <input type="number" id="jumlahKanvasTimSeminggu" name="jumlahKanvasTimSeminggu"
                        placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="iklanOnline" class="block text-sm font-medium text-gray-700">Iklan Online</label>
                    <input type="text" id="iklanOnline" name="iklanOnline" placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="postingSosmed" class="block text-sm font-medium text-gray-700">Posting Sosmed</label>
                    <input type="text" id="postingSosmed" name="postingSosmed" placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="janjiTemuDanKunjungan" class="block text-sm font-medium text-gray-700">Janji Temu dan
                        Kunjungan</label>
                    <input type="text" id="janjiTemuDanKunjungan" name="janjiTemuDanKunjungan"
                        placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="calonKonsCekLokasi" class="block text-sm font-medium text-gray-700">Calon Kons. Cek
                        Lokasi</label>
                    <input type="text" id="calonKonsCekLokasi" name="calonKonsCekLokasi"
                        placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="totalDataLeads" class="block text-sm font-medium text-gray-700">Total Data Leads</label>
                    <input type="number" id="totalDataLeads" name="totalDataLeads" placeholder='Masukan Data Disini'
                        required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="dataProspek" class="block text-sm font-medium text-gray-700">Data Prospek</label>
                    <input type="text" id="dataProspek" name="dataProspek" placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="hotProspek" class="block text-sm font-medium text-gray-700">Hot Prospek</label>
                    <input type="text" id="hotProspek" name="hotProspek" placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="booking" class="block text-sm font-medium text-gray-700">Booking</label>
                    <input type="text" id="booking" name="booking" placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="pemberkasan" class="block text-sm font-medium text-gray-700">Pemberkasan</label>
                    <input type="text" id="pemberkasan" name="pemberkasan" placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="closingAkadCash" class="block text-sm font-medium text-gray-700">Closing Akad/Cash
                        (Rp)</label>
                    <input type="number" step="0.01" id="closingAkadCash" name="closingAkadCash"
                        placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <div>
                    <label for="rencanaTargetClosingDalam1Bulan" class="block text-sm font-medium text-gray-700">Rencana
                        Target Closing Dalam 1 Bulan</label>
                    <input type="text" id="rencanaTargetClosingDalam1Bulan" name="rencanaTargetClosingDalam1Bulan"
                        placeholder='Masukan Data Disini' required
                        class="block w-full border border-gray-300 rounded-lg py-2 px-4 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                </div>

                <button type="submit"
                    class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit</button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Mingguan Data</h1>

            @if ($mingguanData->isEmpty())
                <p>No data available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Project Area</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Periode</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Jumlah Kanva</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Kanvas Tim Seminggu</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Iklan Online</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Posting Sosmed</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Janji Temu dan Kunjungan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Calon Kons. Cek Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Data Leads</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data Prospek</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hot Prospek</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Booking</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pemberkasan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Closing Akad/Cash</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rencana Target Closing Dalam 1 Bulan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($mingguanData as $index => $mingguan)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->projectArea }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->periode }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->totalJumlahKanva }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->jumlahKanvasTimSeminggu }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->iklanOnline }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->postingSosmed }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->janjiTemuDanKunjungan }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->calonKonsCekLokasi }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->totalDataLeads }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->dataProspek }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->hotProspek }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->booking }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $mingguan->pemberkasan }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        Rp. {{ number_format($mingguan->closingAkadCash, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $mingguan->rencanaTargetClosingDalam1Bulan }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <a href="{{ route('mingguan.edit', ['id' => Crypt::encrypt($mingguan->id)]) }}"
                                            class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-600 transition duration-300">Edit</a>
                                        <form
                                            action="{{ route('mingguan.destroy', ['id' => Crypt::encrypt($mingguan->id)]) }}"
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
