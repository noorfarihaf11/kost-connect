<nav class="fixed top-0 left-0 w-full bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 z-50">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="https://flowbite.com" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Kost Connect</span>
        </a>
        <div class="flex items-center lg:order-2">
            @auth
                @if (Auth::user()->isCustomer())
                    <a href="/status-reservasi"
                        class="text-gray-800 hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 
                        {{ Request::is('status-reservasi') ? 'text-primary-700 font-bold' : 'text-gray-900' }}">
                        Status Reservasi
                    </a>
                @endif

                <!-- Tombol Profil User -->
                <div class="relative">
                    <button type="button"
                        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="{{ Auth::user()->profile_picture ?? 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                            alt="user photo">
                    </button>

                    <!-- Dropdown Profil -->
                    <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown">
                        <div class="py-3 px-4">
                            <span
                                class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span
                                class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <a href="/status-reservasi"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                    Reservasi Saya
                                </a>
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            @guest
                <a href="/login"
                    class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    Log in
                </a>
                <a href="/masuk"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    Register
                </a>
            @endguest
        </div>
        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="/home"
                        class="block py-2 px-4 rounded lg:p-0 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700
                        {{ Request::is('home') ? 'text-primary-700 font-bold' : 'text-gray-900' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/daftarkost"
                        class="block py-2 px-4 rounded lg:p-0 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700
                        {{ Request::is('daftarkost') ? 'text-primary-700 font-bold' : 'text-gray-900' }}">
                        Kost
                    </a>
                </li>
            </ul>            
        </div>
    </div>
</nav>
