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

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden', !show);
        }
    </script>
@endsection
