@extends('mh.templates.index')

@section('page-mh')
    <div class="overflow-x-auto">
        <div class="font-bold text-xl md:text-2xl pt-1 text-center p-3 md:p-5">
            <h1>Form Penilaian Kinerja Karyawan (Form Performance Appraisal)</h1>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-400 text-xs md:text-sm">
                <thead>
                    <tr class="bg-blue-500 text-white text-center">
                        <th class="border border-gray-400 p-2 w-10">No</th>
                        <th class="border border-gray-400 p-2 w-60">Kompetensi/Perilaku</th>
                        <th class="border border-gray-400 p-2" colspan="5">Nilai sesuai Angka yang Dipilih</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class=" text-center">
                        <td class="border-r border-l p-2 border-gray-400"></td>
                        <td class="border-r border-l p-2 border-gray-400"></td>
                        <td class="border  p-2 bg-green-200">1</td>
                        <td class="border border-gray-400 p-2 bg-green-200">2</td>
                        <td class="border border-gray-400 p-2 bg-green-200">3</td>
                        <td class="border border-gray-400 p-2 bg-green-200">4</td>
                        <td class="border border-gray-400 p-2 bg-green-200">5</td>
                    </tr>
                    <tr class="align-top text-xs">
                        <td class="border-l border-gray-400 p-2  pt-10" colspan="1">1</td>
                        <td class="border-l border-gray-400 p-2  pt-10">
                            Striving for Excellence <br>
                            (Berupaya Meraih Hasil Terbaik)
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Seringkali menghasilkan pekerjaan yang kualitasnya di bawah standar yang telah ditetapkan; baik
                            dari
                            segi ketepatan waktu dan juga akurasi pekerjaannya.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Kurang mampu menghasilkan pekerjaan yang kualitasnya di bawah standar yang telah ditetapkan;
                            baik
                            dari segi ketepatan waktu dan juga mutu serta akurasi pekerjaannya.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Mampu menghasilkan pekerjaan yang sesuai standar yang telah ditetapkan; baik dari segi ketepatan
                            waktu dan juga mutu pekerjaannya.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Selalu menghasilkan pekerjaan yang sesuai standar yang telah ditetapkan; baik dari segi
                            ketepatan
                            waktu dan juga mutu pekerjaannya.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Selalu menghasilkan pekerjaan yang kualitasnya sesuai standar yang telah ditetapkan; bahkan
                            seringkali lebih tinggi/di atas standar, baik dari segi ketepatan waktu dan juga mutu
                            pekerjaannya.
                        </td>
                    </tr>
                    <!-- Tambahkan baris lainnya dengan struktur serupa -->
                    <tr class=" text-center">
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border  p-2 bg-green-200">1</td>
                        <td class="border border-gray-400 p-2 bg-green-200">2</td>
                        <td class="border border-gray-400 p-2 bg-green-200">3</td>
                        <td class="border border-gray-400 p-2 bg-green-200">4</td>
                        <td class="border border-gray-400 p-2 bg-green-200">5</td>
                    </tr>
                    <tr class="align-top">
                        <td class="border-l border-gray-400 p-2  pt-10" colspan="1">2</td>
                        <td class="border-l border-gray-400 p-2  pt-10">
                            Problem Solving <br>
                            (Kecakapan dalam Memecahkan Masalah)
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Tidak memiliki kemampuan untuk menganalisa masalah, mengidentifikasi sumber masalah dan
                            merumuskan
                            solusi
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Kurang memiliki kemampuan untuk menganalisa masalah, mengidentifikasi sumber masalah dan
                            merumuskan
                            solusi
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki kemampuan yang cukup baik untuk menganalisa masalah, mengidentifikasi sumber masalah
                            dan
                            merumuskan solusi
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki kemampuan yang baik untuk menganalisa masalah, mengidentifikasi sumber masalah secara
                            komprehensif dan merumuskan solusi dengan tepat sasaran.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki kemampuan yang amat baik untuk menganalisa masalah, mengidentifikasi sumber masalah dan
                            merumuskan solusi secara tepat dan memberikan impak sangat positif bagi kemajuan perusahaan.
                        </td>
                    </tr>
                    <!-- Tambahkan baris lainnya dengan struktur serupa -->
                    <tr class=" text-center">
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border  p-2 bg-green-200">1</td>
                        <td class="border border-gray-400 p-2 bg-green-200">2</td>
                        <td class="border border-gray-400 p-2 bg-green-200">3</td>
                        <td class="border border-gray-400 p-2 bg-green-200">4</td>
                        <td class="border border-gray-400 p-2 bg-green-200">5</td>
                    </tr>
                    <tr class="align-top">
                        <td class="border-l border-gray-400 p-2  pt-10" colspan="1">3</td>
                        <td class="border-l border-gray-400 p-2  pt-10">
                            Motivasi dan Ketekunan dalam Kerja
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Tidak mampu menunjukkan motivasi kerja yang tinggi dalam menyelesaikan pekerjaan sehari-hari;
                            sering
                            melontarkan keluhan yang negatif; kurang tekun dan ulet dalam menuntaskan pekerjaan
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Kurang mampu menunjukkan motivasi kerja yang tinggi dalam menyelesaikan pekerjaan sehari-hari;
                            kadangkala melontarkan keluhan yang negatif; kadang menunjukkan sikap kurang tekun dan ulet
                            dalam
                            menuntaskan pekerjaan.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Cukup mampu menunjukkan motivasi kerja yang tinggi dalam menyelesaikan pekerjaan sehari-hari;
                            cukup
                            tekun dan ulet dalam menuntaskan pekerjaan.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Mampu memperlihatkan motivasi kerja yang tinggi dalam menyelesaikan pekerjaan sehari-hari;
                            melihat
                            tantangan pekerjaan dari kacamata positif; memiliki sikap optimis; mampu menunjukkan ketekukan
                            dan
                            ulet dalam menuntaskan pekerjaan.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Selalu mampu motivasi kerja yang sangat tinggi dalam menyelesaikan pekerjaan sehari-hari; selalu
                            melihat tantangan pekerjaan dari kacamata positif; memiliki sikap optimis; selalu mampu
                            menunjukkan
                            ketekukan dan ulet dalam menuntaskan pekerjaan.
                        </td>
                    </tr>

                    <!-- Tambahkan baris lainnya dengan struktur serupa -->
                    <tr class=" text-center">
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border  p-2 bg-green-200">1</td>
                        <td class="border border-gray-400 p-2 bg-green-200">2</td>
                        <td class="border border-gray-400 p-2 bg-green-200">3</td>
                        <td class="border border-gray-400 p-2 bg-green-200">4</td>
                        <td class="border border-gray-400 p-2 bg-green-200">5</td>
                    </tr>
                    <tr class="align-top">
                        <td class="border-l border-gray-400 p-2  pt-10" colspan="1">4</td>
                        <td class="border-l border-gray-400 p-2  pt-10">
                            Disiplin Kerja
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki sikap disiplin yang rendah (sering minta ijin, lebih dari 4 kali) dan sering datang
                            terlambat (> 4 kali) tanpa alasan yang jelas dan logis. Seringkali menujukkan sikap kerja yang
                            lamban dan tidak bersemangat, sehingga terlambat dalam menuntaskan pekerjaan.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki sikap disiplin yang kurang baik (sering minta ijin, lebih dari 2 kali) dan sering
                            datang
                            terlambat (> 2 kali) tanpa alasan yang jelas dan logis. Kadang-kadang menujukkan sikap kerja
                            yang
                            lamban dan tidak bersemangat, sehingga terlambat dalam menuntaskan pekerjaan.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki sikap disiplin yang cukup baik (minta ijin hanya sekali) dan datang tepat waktu. Mampu
                            menujukkan sikap kerja yang cekatan dan bersemangat, sehingga dapat menuntaskan pekerjaan dengan
                            baik.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki sikap disiplin yang baik baik (tidak pernah ijin tanpa alasan yang jelas dan tidak
                            pernah
                            terlambat. Seringkali mampu menujukkan sikap kerja yang cekatan dan bersemangat, sehingga dapat
                            menuntaskan pekerjaan dengan baik.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki sikap disiplin yang cukup baik (minta ijin hanya sekali) dan datang tepat waktu. Mampu
                            menujukkan sikap kerja yang cekatan dan bersemangat, sehingga dapat menuntaskan pekerjaan dengan
                            baik.
                        </td>
                    </tr>

                    <!-- Tambahkan baris lainnya dengan struktur serupa -->
                    <tr class=" text-center">
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border-r border-l border-t p-2 border-gray-400"></td>
                        <td class="border  p-2 bg-green-200">1</td>
                        <td class="border border-gray-400 p-2 bg-green-200">2</td>
                        <td class="border border-gray-400 p-2 bg-green-200">3</td>
                        <td class="border border-gray-400 p-2 bg-green-200">4</td>
                        <td class="border border-gray-400 p-2 bg-green-200">5</td>
                    </tr>
                    <tr class="align-top">
                        <td class="border-l border-gray-400 p-2  pt-10" colspan="1">5</td>
                        <td class="border-l border-gray-400 p-2  pt-10">
                            Pengetahuan Teknis <br>(Skills dan Knowledge)
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Tidak memiliki kecakapan teknis atau ketrampilan teknis yang dibutuhkan untuk menyelesaikan
                            tugasnya. Tidak menguasai bidang tugasnya secara mendalam; sering melakukan kesalahan dalam
                            proses
                            kerja.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Kurang memiliki kecakapan teknis atau ketrampilan teknis yang dibutuhkan untuk menyelesaikan
                            tugasnya. Kurang menguasai bidang tugasnya secara mendalam; kadang-kadang melakukan kesalahan
                            dalam
                            proses kerja.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Cukup memiliki kecakapan teknis atau ketrampilan teknis yang dibutuhkan untuk menyelesaikan
                            tugasnya. Cukup menguasai bidang tugasnya secara mendalam; jarang melakukan kesalahan dalam
                            proses
                            kerja.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki kecakapan teknis atau ketrampilan teknis yang baik dan dibutuhkan untuk menyelesaikan
                            tugasnya. Mampu menguasai bidang tugasnya secara mendalam; sangat jarang melakukan kesalahan
                            dalam
                            proses kerja.
                        </td>
                        <td class="border border-gray-400 p-2 text-left">
                            Memiliki kecakapan teknis atau ketrampilan teknis yang sangat baik dan dibutuhkan untuk
                            menyelesaikan tugasnya. Sangat menguasai bidang tugasnya secara mendalam; tidak pernah melakukan
                            kesalahan dalam proses kerja.
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-green-500 text-white text-center">
                        <td class="border border-gray-400 p-2" colspan="7">
                            Nilai Rata-rata Aspek Perilaku Karyawan
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
