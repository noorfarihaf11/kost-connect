<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create account - Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                        src="../assets/img/create-account-office.jpeg" alt="Office" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                        src="../assets/img/create-account-office-dark.jpeg" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('registError'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                            role="alert">
                            {{ session('registError') }}
                        </div>
                    @endif
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Daftar sebagai {{ $role === 'pemilik' ? 'Pemilik Kos' : 'Pencari Kos' }}
                        </h1>

                        <form action="{{ $role === 'pemilik' ? route('register.pemilik') : route('register') }}"
                            method="POST">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Name</span>
                                <input
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 
                                           focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray 
                                           form-input @error('name') border-red-500 @enderror"
                                    type="text" id="name" name="name" placeholder="Jane Doe"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </label>
                            
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 
                                           focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray 
                                           form-input @error('email') border-red-500 @enderror"
                                    type="email" id="email" name="email" placeholder="Use @gmail"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </label>
                            
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 
                                           focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray 
                                           form-input @error('password') border-red-500 @enderror"
                                    type="password" id="password" name="password" placeholder="*****" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </label>
                            
                            <label class="block mt-4 text-sm" style="{{ $role === 'pemilik' ? '' : 'display: none;' }}">
                                <span class="text-gray-700 dark:text-gray-400">Nomor Handphone</span>
                                <input
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 
                                           focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray 
                                           form-input @error('no_tlp') border-red-500 @enderror"
                                    type="text" id="no_tlp" name="no_tlp" placeholder="08*****"
                                    value="{{ old('no_tlp') }}" />
                                @error('no_tlp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </label>
                            
                            <label class="block mt-4 text-sm" style="{{ $role === 'pemilik' ? '' : 'display: none;' }}">
                                <span class="text-gray-700 dark:text-gray-400">Alamat Rumah</span>
                                <input
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 
                                           focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray 
                                           form-input @error('address') border-red-500 @enderror"
                                    type="text" id="address" name="address" placeholder="Alamat Pribadi"
                                    value="{{ old('address') }}" />
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </label>                            

                            <button
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors 
                                       duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 
                                       hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                type="submit">
                                Create account
                            </button>
                        </form>


                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                href="/login">
                                Already have an account? Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
