@extends('dashboard.layouts.main')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>
        <div
            class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                </svg>
                <span>
                    @if (Gate::allows('admin'))
                        <p>
                            Selamat datang Admin!
                        </p>
                    @elseif (Gate::allows('owner'))
                        <p>Selamat datang, {{ $ownerName }}! Kamu memiliki {{ $totalReservasi ?? 0 }} reservasi yang
                            harus diterima.</p>
                    @endif
                </span>
            </div>
            <a href="/reservation"
                class="text-white bg-purple-500 px-4 py-2 rounded-md hover:bg-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-300">
                Lihat Reservasi
            </a>
        </div>
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Pembayaran
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        @if ($totalAmount > 0)
                            Rp. {{ number_format($totalAmount, 0, ',', '.') }}
                        @else
                            Belum ada pembayaran
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div>
                    @if (Gate::allows('admin'))
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Pemilik Rumah Kost
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            @if ($totalOwner > 0)
                                {{ $totalOwner }}
                            @else
                                Belum ada penghuni kost
                            @endif
                        </p>
                    @elseif (Gate::allows('owner'))
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Penghuni Kamar
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            @if ($totalCustomer > 0)
                                {{ $totalCustomer }}
                            @else
                                Belum ada penghuni kost
                            @endif
                        </p>
                    @endif
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <i class="fa-solid fa-bed"></i>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Kamar Kost
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        @if ($totalKamar > 0)
                            {{ $totalKamar }}
                        @else
                            Belum ada kamar kost
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Rumah Kost
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        @if ($totalRumah > 0)
                            {{ $totalRumah }}
                        @else
                            Belum ada rumah kost
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kamar</th>
                            <th class="px-4 py-3">Rumah</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($customers as $customer)
                            <tr class="text-gray-700 dark:text-gray-400 text-center">
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $customer->id_customer }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-center">
                                        <p class="font-semibold"> {{ $customer->reservation->user->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $customer->phone_number }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $customer->reservation->room->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $customer->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($customer->customer_status == 'inactive')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Inactive
                                        </span>
                                    @elseif ($customer->customer_status == 'active')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Active
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
