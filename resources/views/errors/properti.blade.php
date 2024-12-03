@extends('errors.templates.index')

<section class="relative bg-cover bg-center" style="background-image: url('{{ asset('foto/home2.jpg') }}');">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-blue-500 to-green-400 opacity-60"></div>

    <div class="relative container mx-auto h-screen flex items-center justify-center">
        <div class="text-center text-white">
            <h1
                class="text-6xl font-bold mb-4 bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 bg-clip-text text-transparent">
                404
            </h1>
            <h2
                class="text-3xl font-semibold mb-6 bg-gradient-to-r from-teal-400 to-cyan-500 bg-clip-text text-transparent">
                Oops! Page Not Found
            </h2>
            <p class="text-lg mb-8 text-gray-300">
                The page you’re looking for doesn’t exist or has been moved.
            </p>
            <a href="{{ url('/') }}"
                class="inline-block px-6 py-3 text-lg font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 rounded-md hover:from-blue-600 hover:to-purple-700 transition-colors shadow-lg">
                Back to Home
            </a>
        </div>
    </div>
</section>
