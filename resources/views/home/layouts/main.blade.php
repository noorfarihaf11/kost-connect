<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Connect</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<header>
    @include('home.layouts.header') <!-- Navbar di header -->
</header>
<body class="mt-16"> 
    @yield('content') <!-- Konten halaman -->
    @include('home.layouts.footer') <!-- Footer -->
</body>

</html>
