<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... other head elements ... -->
    @vite('resources/css/app.css')
    <!-- or if using Laravel Mix: -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    <!-- Your content here -->
</body>
</html>