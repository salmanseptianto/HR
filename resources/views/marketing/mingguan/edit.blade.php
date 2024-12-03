@extends('marketing.templates.index')

@section('page-dashboard')
    <div class="container mx-auto px-4 py-6">
        <!-- Edit Mingguan Data Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Edit Mingguan Data</h1>

            <form action="{{ route('mingguan.update',  ['id' => Crypt::encrypt($mingguan->id)])}}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    <label for="projectArea" class="text-lg font-medium mb-1">Project</label>
                    <select id="projectArea" name="projectArea" class="form-select border border-gray-300 rounded-lg p-2"
                        required>
                        <option value="sakinah" {{ $mingguan->projectArea == 'sakinah' ? 'selected' : '' }}>Sakinah 2
                        </option>
                        <option value="savill" {{ $mingguan->projectArea == 'savill' ? 'selected' : '' }}>Savill</option>
                        <option value="triehans" {{ $mingguan->projectArea == 'triehans' ? 'selected' : '' }}>Triehans
                        </option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="periode" class="text-lg font-medium mb-1">Periode</label>
                    <input type="date" id="periode" name="periode" value="{{ $mingguan->periode }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="totalJumlahKanva" class="text-lg font-medium mb-1">Total Jumlah Kanva</label>
                    <input type="text" id="totalJumlahKanva" name="totalJumlahKanva"
                        value="{{ $mingguan->totalJumlahKanva }}" class="form-input border border-gray-300 rounded-lg p-2"
                        required>
                </div>

                <div class="flex flex-col">
                    <label for="jumlahKanvasTimSeminggu" class="text-lg font-medium mb-1">Jumlah Kanvas Tim Seminggu</label>
                    <input type="number" id="jumlahKanvasTimSeminggu" name="jumlahKanvasTimSeminggu"
                        value="{{ $mingguan->jumlahKanvasTimSeminggu }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="iklanOnline" class="text-lg font-medium mb-1">Iklan Online</label>
                    <input type="text" id="iklanOnline" name="iklanOnline" value="{{ $mingguan->iklanOnline }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="postingSosmed" class="text-lg font-medium mb-1">Posting Sosmed</label>
                    <input type="text" id="postingSosmed" name="postingSosmed" value="{{ $mingguan->postingSosmed }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="janjiTemuDanKunjungan" class="text-lg font-medium mb-1">Janji Temu dan Kunjungan</label>
                    <input type="text" id="janjiTemuDanKunjungan" name="janjiTemuDanKunjungan"
                        value="{{ $mingguan->janjiTemuDanKunjungan }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="calonKonsCekLokasi" class="text-lg font-medium mb-1">Calon Kons. Cek Lokasi</label>
                    <input type="text" id="calonKonsCekLokasi" name="calonKonsCekLokasi"
                        value="{{ $mingguan->calonKonsCekLokasi }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="totalDataLeads" class="text-lg font-medium mb-1">Total Data Leads</label>
                    <input type="number" id="totalDataLeads" name="totalDataLeads" value="{{ $mingguan->totalDataLeads }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="dataProspek" class="text-lg font-medium mb-1">Data Prospek</label>
                    <input type="text" id="dataProspek" name="dataProspek" value="{{ $mingguan->dataProspek }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="hotProspek" class="text-lg font-medium mb-1">Hot Prospek</label>
                    <input type="text" id="hotProspek" name="hotProspek" value="{{ $mingguan->hotProspek }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="booking" class="text-lg font-medium mb-1">Booking</label>
                    <input type="text" id="booking" name="booking" value="{{ $mingguan->booking }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="pemberkasan" class="text-lg font-medium mb-1">Pemberkasan</label>
                    <input type="text" id="pemberkasan" name="pemberkasan" value="{{ $mingguan->pemberkasan }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="closingAkadCash" class="text-lg font-medium mb-1">Closing Akad/Cash (Rp)</label>
                    <input type="number" step="0.01" id="closingAkadCash" name="closingAkadCash"
                        value="{{ $mingguan->closingAkadCash }}" class="form-input border border-gray-300 rounded-lg p-2"
                        required>
                </div>

                <div class="flex flex-col">
                    <label for="rencanaTargetClosingDalam1Bulan" class="text-lg font-medium mb-1">Rencana Target Closing
                        Dalam 1 Bulan</label>
                    <input type="text" id="rencanaTargetClosingDalam1Bulan" name="rencanaTargetClosingDalam1Bulan"
                        value="{{ $mingguan->rencanaTargetClosingDalam1Bulan }}"
                        class="form-input border border-gray-300 rounded-lg p-2" required>
                </div>

                <div class="flex space-x-4 mt-6">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Update
                    </button>
                    <a href="{{ route('mingguan') }}"
                        class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
