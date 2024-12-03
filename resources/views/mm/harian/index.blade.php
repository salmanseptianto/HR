@extends('mm.templates.index')

@section('page-dashboard')
    <div class="container mt-4">
        <h1 class="text-2xl font-semibold mb-4">Harian</h1>

        <div class="space-y-2">
            <a href="{{ route('harian.sakinah') }}" class="text-blue-500 hover:underline">Sakinah</a>
            <a href="{{ route('harian.savill') }}" class="text-blue-500 hover:underline">Savill</a>
            <a href="{{ route('harian.triehans') }}" class="text-blue-500 hover:underline">Triehans</a>
        </div>
    </div>
@endsection
