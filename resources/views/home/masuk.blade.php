<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Peran - KostConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <div class="flex items-center min-h-screen p-6">
        <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="p-6">
                <h1 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6 text-center">
                    Register sebagai?
                </h1>
                <!-- Tombol Pencari Kos -->
                <a href="{{ route('register') }}"
                    class="block w-full px-4 py-2 mb-4 text-center text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">
                    Pencari Kos
                </a>
                <!-- Tombol Pemilik Kos -->
                <a href="{{ route('register.pemilik') }}"
                    class="block w-full px-4 py-2 text-center text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">
                    Pemilik Kos
                </a>
            </div>
        </div>
    </div>
</body>

</html>
