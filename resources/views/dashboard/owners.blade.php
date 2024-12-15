@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        @can('admin')
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Pemilik Rumah Kost
            </h2>
        @else
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Reservasi Saya
            </h2>
        @endif
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Daftar pemilik rumah kost
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
                            <th class="px-4 py-3 text-center w-6">ID </th>
                            <th class="px-4 py-3 text-center w-6">Nama</th>
                            <th class="px-4 py-3">No HP</th>
                            <th class="px-4 py-3">Alamat Pribadi</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($owners as $pemilik)
                            <tr class="text-gray-700 dark:text-gray-400 text-center">
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $pemilik->id_owner }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-center">
                                        <p class="font-semibold">{{ $pemilik->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $pemilik->email }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $pemilik->phone }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $pemilik->address }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($pemilik->owner_status == 'inactive')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Inactive
                                        </span>
                                    @elseif ($pemilik->owner_status == 'active')
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
