@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        @if (Gate::allows('admin') || Gate::allows('owner'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Reservation
            </h2>
        @else
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Reservasi Saya
            </h2>
        @endif
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Daftar reservasi
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
                            <th class="px-4 py-3 text-center w-6">ID</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3 text-center w-6">Kamar</th>
                            <th class="px-4 py-3 text-center w-6">Alamat</th>
                            <th class="px-4 py-3 text-center w-6">Harga</th>
                            <th class="px-4 py-3">TGL Kunjung</th>
                            <th class="px-4 py-3">Notes</th>
                            <th class="px-4 py-3">Status</th>
                            @can('owner')
                                <th class="px-4 py-3">Actions</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($reservations as $reservasi)
                            <tr class="text-gray-700 dark:text-gray-400 text-center">
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $reservasi->id_reservation }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-center">
                                        <p class="font-semibold">{{ $reservasi->user->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $reservasi->phone_number }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $reservasi->room->name }}
                                </td>
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $reservasi->room->house->address }}
                                </td>
                                <td class="px-3 py-2 text-sm w-6">
                                    Rp {{ number_format($reservasi->room->price_per_month, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $reservasi->reservation_date }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $reservasi->notes }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($reservasi->reservation_status == 1)
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Diajukan
                                        </span>
                                    @elseif ($reservasi->reservation_status == 2)
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Diterima
                                        </span>
                                    @elseif ($reservasi->reservation_status == 3)
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @can('owner')
                                        @if ($reservasi->reservation_status == 2)
                                            <button
                                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none"
                                                type="button" disabled>
                                                Diterima
                                            </button>
                                        @else
                                            <button
                                                class="accReservation px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                                type="button" data-id="{{ $reservasi->id_reservation }}"
                                                data-reservation_status="{{ $reservasi->reservation_status }}">
                                                Terima
                                            </button>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="terimareservasiForm" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 sm:w-1/3">
            <form id="updateStatus" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_reservation" id="edit_id_reservation">
                <input type="hidden" name="reservation_status" id="edit_reservation_status" value="1">
                <div class="flex justify-between items-center p-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Terima Reservasi</h2>
                    <button id="closeModalButton" type="button"
                        class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-200" aria-label="close">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-4">
                    <p class="text-sm text-gray-700 dark:text-gray-400">
                        Dengan mengonfirmasi, reservasi ini akan diterima dan penyewa akan diberi tahu. Apakah Anda ingin
                        melanjutkan?
                    </p>
                </div>

                <div class="flex justify-end p-4 border-t">
                    <button id="rejectButton" type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-red-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Tolak
                    </button>

                    <button id="acceptButton" type="button"
                        class="ml-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">
                        Terima
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery -->
    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('.accReservation').click(function() {
                const id = $(this).data('id');
                const reservation_status = $(this).data('reservation_status');

                $('#edit_id_reservation').val(id);
                $('#edit_reservation_status').val(reservation_status);

                $('#terimareservasiForm').show(); // Open the modal
            });

            $('#closeModalButton').click(function() {
                $('#terimareservasiForm').hide(); // Hide the modal
            });

            $('#acceptButton').click(function() {
                $('#edit_reservation_status').val(2); // Set reservation_status menjadi 2 (Terima)
                $('#updateStatus').submit(); // Kirim form
            });

            // Ketika tombol "Tolak" diklik
            $('#rejectButton').click(function() {
                $('#edit_reservation_status').val(3); // Set reservation_status menjadi 3 (Tolak)
                $('#updateStatus').submit(); // Kirim form
            });

            $('#updateStatus').on('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secara default

                const id = $('#edit_id_reservation').val(); // Ambil ID dari input tersembunyi
                const url = '/reservation/' + id; // URL untuk permintaan PUT
                const formData = $(this).serialize(); // Serialize data form

                console.log("Submitting data:");
                console.log("ID:", id);
                console.log("URL:", url);
                console.log("Form Data:", formData);

                $.ajax({
                    url: url,
                    type: 'POST', // Menggunakan metode POST dengan CSRF token
                    data: formData, // Kirim data form
                    success: function(response) {
                        if (response.success) {
                            alert('Reservation updated successfully!');
                            location.reload(); // Reload halaman setelah update berhasil
                        } else {
                            alert('Update failed: ' + response
                            .message); // Menampilkan pesan jika gagal
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr
                        .responseText); // Menampilkan error jika ada masalah
                    }
                });
            });
        });
    </script>
@endsection
