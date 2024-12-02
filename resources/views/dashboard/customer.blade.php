@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        @if (auth()->check() && auth()->user()->id_role == 1)
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Penghuni Kos
            </h2>
        @else
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Reservasi Saya
            </h2>
        @endif
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Daftar penghuni kost
            </h4>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3 text-center w-6">ID Reservasi</th>
                            <th class="px-4 py-3 text-center w-6">Kamar</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Tanggal Masuk</th>
                            <th class="px-4 py-3">Tanggal Keluar</th>
                            <th class="px-4 py-3">Status</th>
                            {{-- @if (auth()->check() && auth()->user()->id_role == 1)
                                <th class="px-4 py-3">Actions</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($customers as $penghuni)
                            <tr class="text-gray-700 dark:text-gray-400 text-center">
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $penghuni->reservation->id_reservation }}
                                </td>
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $penghuni->reservation->room->name_room }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-center">
                                        <p class="font-semibold">{{ $penghuni->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $penghuni->phone_number }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $penghuni->start_date }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $penghuni->end_date }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($penghuni->customer_status == 'inactive')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Inactive
                                        </span>
                                    @elseif ($penghuni->customer_status == 'active')
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
@endsection
