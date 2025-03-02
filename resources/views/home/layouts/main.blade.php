<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Connect</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/app.js') }}">
</head>
<style>
    #homeLink.active,
    #kostLink.active,
    #aboutLink.active,
    #kotaLink.active,
    #testimoniLink.active{
        color: #1d4ed8;
        font-weight: bold;  
    }
</style>

<header>
    @include('home.layouts.header') <!-- Navbar di header -->
</header>

<body class="mt-16">
    @yield('content') <!-- Konten halaman -->
    @include('home.layouts.footer') <!-- Footer -->
</body>

</html>
