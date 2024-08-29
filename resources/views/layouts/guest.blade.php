<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Aplikasi Analisis Kesiapan Adopsi Teknologi Artificial Intelligence Mahasiswa Komputer
        Universitas Putra
        Indonesia “YPTK” Padang
    </title>

    <link rel="icon" href="{{ asset('storage/logo-univ.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div>
            <a href="/">
                <x-application-logo class="w-full h-40 text-gray-500 fill-current" />
            </a>
        </div>
        <p class="text-center">
            Aplikasi Analisis Kesiapan Adopsi Teknologi Artificial Intelligence Mahasiswa Komputer
        </p>
        <p class="text-2xl font-semibold text-center">
            Universitas Putra Indonesia “YPTK” Padang
        </p>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
