@extends('errors.home.templates.index')

@section('content')
    <section class="relative bg-cover bg-center" style="background-image: url('{{ asset('foto/image/home2.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative container mx-auto h-screen flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-6xl font-bold mb-4">404</h1>
                <h2 class="text-3xl font-semibold mb-6">Oops! Page Not Found</h2>
                <p class="text-lg mb-8">The page you’re looking for doesn’t exist or has been moved.</p>
                <a href="{{ url('/admin') }}"
                    class="inline-block px-6 py-3 text-lg font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">Back
                    to Home</a>
            </div>
        </div>
    </section>
@endsection
