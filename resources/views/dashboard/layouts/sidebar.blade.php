<div class="flex h-screen bg-gray-50 dark:bg-gray-900">
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Kost Connect
            </a>
            @auth
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <a href="/dashboard"
                           class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('dashboard') ? 'text-gray-800' : 'text-gray-600' }}">
                            <i class="fas fa-tachometer-alt {{ request()->is('dashboard') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                            <span class="ml-4 {{ request()->is('dashboard') ? 'font-bold text-gray-800' : '' }}">Dashboard</span>
                        </a>
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('dashboard') ? 'block' : 'hidden' }}"></span>
                    </li>
                </ul>
                <ul>
                    @if (Gate::allows('owner'))
                        <li class="relative px-6 py-3">
                            <a href="/rumahkost"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('rumahkost') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fa-solid fa-house {{ request()->is('rumahkost') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('rumahkost') ? 'font-bold text-gray-800' : '' }}">Rumah Kost</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('rumahkost') ? 'block' : 'hidden' }}"></span>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/rooms"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('rooms') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fas fa-bed {{ request()->is('rooms') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('rooms') ? 'font-bold text-gray-800' : '' }}">Kamar Kost</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('rooms') ? 'block' : 'hidden' }}"></span>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/reservation"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('reservation') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fas fa-calendar-alt {{ request()->is('reservation') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('reservation') ? 'font-bold text-gray-800' : '' }}">Reservasi</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('reservation') ? 'block' : 'hidden' }}"></span>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/payment"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('payment') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fas fa-wallet {{ request()->is('payment') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('payment') ? 'font-bold text-gray-800' : '' }}">Pembayaran</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('payment') ? 'block' : 'hidden' }}"></span>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/customer"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('customer') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fas fa-house-user {{ request()->is('customer') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('customer') ? 'font-bold text-gray-800' : '' }}">Penghuni Kos</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('customer') ? 'block' : 'hidden' }}"></span>
                        </li>                        
                        <li class="relative px-6 py-3">
                            <a href="/laporanpembayaran"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('customer') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fa-solid fa-file-pdf {{ request()->is('laporanpembayaran') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('laporanpembayaran') ? 'font-bold text-gray-800' : '' }}">Laporan Pembayaran</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('customer') ? 'block' : 'hidden' }}"></span>
                        </li>                        
                    @else
                        <li class="relative px-6 py-3">
                            <a href="/reservation"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('reservation') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fas fa-calendar-alt {{ request()->is('reservation') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('reservation') ? 'font-bold text-gray-800' : '' }}">Reservation</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('reservation') ? 'block' : 'hidden' }}"></span>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/payment"
                               class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('payment') ? 'text-gray-800' : 'text-gray-600' }}">
                                <i class="fas fa-wallet {{ request()->is('payment') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                                <span class="ml-4 {{ request()->is('payment') ? 'font-bold text-gray-800' : '' }}">Payment</span>
                            </a>
                            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('payment') ? 'block' : 'hidden' }}"></span>
                        </li>
                    @endauth
                @endif
                @if (Gate::allows('admin'))
                <li class="relative px-6 py-3">
                    <a href="/cities"
                       class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('cities') ? 'text-gray-800' : 'text-gray-600' }}">
                        <i class="fas fa-city {{ request()->is('cities') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                        <span class="ml-4 {{ request()->is('cities') ? 'font-bold text-gray-800' : '' }}">Kota</span>
                    </a>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('cities') ? 'block' : 'hidden' }}"></span>
                </li>
                <li class="relative px-6 py-3">
                    <a href="/owners"
                       class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('owners') ? 'text-gray-800' : 'text-gray-600' }}">
                        <i class="fas fa-user-tie {{ request()->is('owners') ? 'dark:text-gray-200' : 'text-gray-500' }}"></i>
                        <span class="ml-4 {{ request()->is('owners') ? 'font-bold text-gray-800' : '' }}">Pemilik Rumah Kost</span>
                    </a>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ request()->is('owners') ? 'block' : 'hidden' }}"></span>
                </li>
                @endif
            </ul>
            <div class="px-6 my-6">
                <a href="/home"
                   class="flex items-center justify-start w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Home
                </a>
            </div>
        </div>
    </aside>