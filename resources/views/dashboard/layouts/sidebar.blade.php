<div class="flex h-screen bg-gray-50 dark:bg-gray-900">
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Kostzy
            </a>
            @auth
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <a href=/dashboard
                            class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                            <i class="fa-solid fa-house"></i>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    @if (Gate::allows('admin') || Gate::allows('owner'))
                        <li class="relative px-6 py-3">
                            <a href=/cities
                                class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-city"></i>
                                <span class="ml-4">Kota</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href=/roles
                                class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fa-solid fa-users-cog"></i>
                                <span class="ml-4">Role</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href=/users
                                class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fa-solid fa-user-cog"></i>
                                <span class="ml-4">User</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href=/rooms
                                class=" menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-bed"></i>
                                <span class="ml-4">Kamar kost</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href=/reservation
                                class=" menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="ml-4">Reservasi</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/payment"
                                class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-wallet"></i>
                                <span class="ml-4">Pembayaran</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/customer"
                                class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-house-user"></i>
                                <span class="ml-4">Penghuni Kos</span>
                            </a>
                        </li>
                    @else
                        <li class="relative px-6 py-3">
                            <a href=/reservation
                                class=" menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="ml-4">Reservation</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a href="/payment"
                                class="menu-item inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <i class="fas fa-wallet"></i>
                                <span class="ml-4">Payment</span>
                            </a>
                        </li>
                    @endauth
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
    <script>
        // Menentukan fungsi untuk menambahkan kelas aktif pada menu
        function setActiveMenu() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                const parentLi = item.closest('li');
                const isActive = item.getAttribute('href') === currentPath;

                // Menambahkan atau menghapus kelas aktif
                if (isActive) {
                    // Menambahkan indikator aktif
                    if (!parentLi.querySelector('.active-indicator')) {
                        const activeIndicator = document.createElement('span');
                        activeIndicator.className =
                            'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator';
                        parentLi.insertBefore(activeIndicator, item);
                    }

                    // Menambahkan kelas aktif pada ikon dan teks
                    item.querySelector('i').classList.add('text-gray-800', 'dark:text-gray-200');
                    item.querySelector('span').classList.add('font-semibold');
                } else {
                    // Menghapus indikator dan kelas aktif dari item yang lain
                    const activeIndicator = parentLi.querySelector('.active-indicator');
                    if (activeIndicator) activeIndicator.remove();

                    item.querySelector('i').classList.remove('text-gray-800', 'dark:text-gray-200');
                    item.querySelector('span').classList.remove('font-semibold');
                }
            });
        }

        // Menjalankan fungsi setActiveMenu saat halaman dimuat
        document.addEventListener('DOMContentLoaded', setActiveMenu);
    </script>
