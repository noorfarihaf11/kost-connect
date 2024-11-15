<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Kos Connect
            </a>
            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    <a href=/dashboard class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                        <i class="fa-solid fa-house"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3">
                    <a href=/cities class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                        <i class="fas fa-city"></i>
                        <span class="ml-4">City</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a href=/roles class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                        <i class="fa-solid fa-users-cog"></i>
                        <span class="ml-4">Role</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a href=/users class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                        <i class="fa-solid fa-user-cog"></i>
                        <span class="ml-4">User</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a href=/rooms class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                        <i class="fas fa-bed"></i>
                        <span class="ml-4">Rooms</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
