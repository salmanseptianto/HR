@extends('mm.templates.index')

@section('page-dashboard')
    <div class="container mt-4">
        <h1 class="text-2xl font-semibold mb-4">Mingguan</h1>

        <div class="space-y-2">
            <a href="{{ route('mingguan.sakinah') }}" class="text-blue-500 hover:underline">Sakinah</a>
            <a href="{{ route('mingguan.savill') }}" class="text-blue-500 hover:underline">Savill</a>
            <a href="{{ route('mingguan.triehans') }}" class="text-blue-500 hover:underline">Triehans</a>
        </div>
    </div>

    <script>
        // JavaScript to handle notification visibility
        document.addEventListener('DOMContentLoaded', function() {
            var notification = document.getElementById('notification');
            if (notification) {
                // Hide the notification after 15 seconds
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 15100); // 15.1 seconds
            }
        });
    </script>
@endsection
