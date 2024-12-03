@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        @can('owner')
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Payment
            </h2>
        @else
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Tagihan Saya
            </h2>
            @endif
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                    List tagihan
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
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Kamar</th>
                                <th class="px-4 py-3">Tagihan</th>
                                <th class="px-4 py-3">Pembayaran Via</th>
                                <th class="px-4 py-3">Jatuh Tempo</th>
                                <th class="px-4 py-3">Jenis</th>
                                <th class="px-4 py-3">Status</th>
                                @if (Gate::allows('admin') || Gate::allows('owner'))
                                    <th class="px-4 py-3">Lampiran</th>
                                @else
                                    <th class="px-4 py-3">Pembayaran</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($payments as $tagihan)
                                <tr class="text-gray-700 dark:text-gray-400 text-center">
                                    <td class="px-3 py-2 text-sm w-6">
                                        {{ $tagihan->id_reservation }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-center">
                                            <p class="font-semibold">{{ $tagihan->reservation->user->name }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $tagihan->reservation->phone_number }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $tagihan->reservation->room->name_room }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        Rp {{ number_format($tagihan->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $tagihan->payment_method }}
                                    </td>
                                    <td class="px-3 py-2 text-sm w-6">
                                        {{ $tagihan->payment_due_date }}
                                    </td>
                                    <td class="px-3 py-2 text-sm w-6">
                                        {{ $tagihan->payment_type }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if ($tagihan->payment_status == 'pending')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                                Belum Bayar
                                            </span>
                                        @elseif ($tagihan->payment_status == 'waiting_for_confirmation')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:text-yellow dark:bg-yellow-600">
                                                Menunggu Konfirmasi
                                            </span>
                                        @elseif ($tagihan->payment_status == 'paid')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Terbayar
                                            </span>
                                        @elseif ($tagihan->payment_status == 'failed')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                                Gagal
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (Gate::allows('owner'))
                                            <button
                                                class="seeButtonAdmin px-3 py-1 text-sm font-medium leading-5 text-white bg-blue-600 border border-transparent rounded-md transition-colors duration-150 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                                data-id="{{ $tagihan->id_payment }}"
                                                data-id_reservation="{{ $tagihan->id_reservation }}"
                                                data-name_room="{{ $tagihan->reservation->room->name_room }}"
                                                data-payment_method="{{ $tagihan->payment_method }}"
                                                data-total_amount="{{ $tagihan->total_amount }}"
                                                data-proof_of_payment="{{ $tagihan->proof_of_payment }}">
                                                Lihat
                                            </button>
                                        @else
                                            <button type ="button"
                                                class="detailPaymentButton px-3 py-1 text-sm font-medium leading-5 text-white bg-yellow-600 border border-transparent rounded-md transition-colors duration-150 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-300"
                                                data-id="{{ $tagihan->id_payment }}"
                                                data-id_reservation="{{ $tagihan->id_reservation }}"
                                                data-name_room="{{ $tagihan->reservation->room->name_room }}"
                                                data-payment_method="{{ $tagihan->payment_method }}"
                                                data-total_amount="{{ $tagihan->total_amount }}"
                                                data-proof_of_payment="{{ $tagihan->proof_of_payment }}">
                                                Detail Tagihan
                                            </button>
                                        @endif
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div id="paymentForm" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Detail Tagihan
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="defaultModal" id="closeModalButton">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form id="kirimBukti" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_payment" id="edit_id_payment">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="total_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Tagihan</label>
                                <input type="text" name="total_amount" id="total_amount"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div>
                                <label for="payment_method"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Via Pembayaran</label>
                                <input type="text" name="payment_method" id="payment_method"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="proof_of_payment"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Bukti Pembayaran
                                </label>
                                <div class="flex items-left justify-left w-full">
                                    <img id="proofImagePreview" class="max-w-40 h-40 hidden" alt="Proof of Payment">
                                    <label id="uploadLabel"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16v-1a4 4 0 014-4h2a4 4 0 014 4v1m-6 4a4 4 0 100-8 4 4 0 000 8zm0 0v.01">
                                                </path>
                                            </svg>
                                            <input id="proof_of_payment" name="proof_of_payment" type="file"
                                                class="hidden">
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Klik untuk mengunggah</span> atau tarik file
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, atau PDF (Max.
                                                2MB)</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            @if (Gate::allows('owner'))
                                @if ($tagihan->proof_of_payment)
                                    <button data-id="{{ $tagihan->id_payment }}"
                                        data-payment_status="{{ $tagihan->payment_status }}" type="button"
                                        class="confirmPaymentButton text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-700">
                                        Konfirmasi Pembayaran
                                    </button>
                                @else
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        Belum ada bukti pembayaran.
                                    </span>
                                @endif
                            @else
                                @if ($tagihan->proof_of_payment)
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        Bukti pembayaran sudah dikirim.
                                    </span>
                                @else
                                    <button data-id="{{ $tagihan->id_payment }}"
                                        class="kirimBukti text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        Kirim
                                    </button>
                                @endif
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div id="terimaPembayaranForm" style="display: none;"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg w-11/12 sm:w-1/3">
                    <!-- Modal Header -->
                    <form id="updateStatus" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_payment" id="edit_id_payment">
                        <input type="hidden" name="payment_status" id="edit_payment_status" value="paid">
                        <div class="flex justify-between items-center p-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Terima Pembayaran</h2>
                            <button id="closeModalButton" type="button"
                                class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-200" aria-label="close">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                                    aria-hidden="true">
                                    <path
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="p-4">
                            <p class="text-sm text-gray-700 dark:text-gray-400">
                                Dengan mengonfirmasi, pelanggan akan menjadi penyewa kamar. Apakah Anda
                                ingin
                                melanjutkan?
                            </p>
                        </div>
                        <div class="flex justify-end p-4 border-t">
                            <button
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-red-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300"
                                onclick="closeModal()">
                                Tolak
                            </button>
                            <button type="submit"
                                class="ml-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">
                                Terima
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery -->
        <script>
            $(document).ready(function() {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $('.detailPaymentButton, .seeButtonAdmin').click(function() {
                    const id = $(this).data('id');
                    const id_reservation = $(this).data('id_reservation');
                    const name_room = $(this).data('name_room');
                    const payment_method = $(this).data('payment_method');
                    const total_amount = $(this).data('total_amount');
                    const proof_of_payment = $(this).data('proof_of_payment');

                    // Mengisi nilai ke input form
                    $('#edit_id_payment').val(id);
                    $('#id_reservation').val(id_reservation);
                    $('#name_room').val(name_room);
                    $('#payment_method').val(payment_method);
                    $('#total_amount').val(total_amount);

                    // Cek apakah ada bukti pembayaran
                    if (proof_of_payment) {
                        const proofUrl = `/storage/payments/${proof_of_payment}`;
                        $('#proofImagePreview').attr('src', proofUrl).removeClass('hidden'); // Tampilkan gambar
                        $('#uploadLabel').addClass('hidden'); // Sembunyikan label unggah
                    } else {
                        $('#proofImagePreview').addClass('hidden'); // Sembunyikan gambar
                        $('#uploadLabel').removeClass('hidden'); // Tampilkan label unggah
                    }

                    $('#paymentForm').removeClass('hidden');
                });

                $('#closeModalButton').click(function() {
                    $('#paymentForm').addClass('hidden');
                });

                $('.confirmPaymentButton').click(function() {
                    const id = $(this).data('id');
                    const payment_status = $(this).data('payment_status');

                    $('#edit_id_reservation').val(id);
                    $('#edit_payment_status').val(payment_status);

                    $('#terimaPembayaranForm').show(); // Open the modal
                });

                // Handler untuk Kirim Bukti Pembayaran
                $('#kirimBukti').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const id = $('#edit_id_payment').val(); // Ambil ID pembayaran
                    const url = '/payment/' + id + '/upload-proof'; // Endpoint untuk upload bukti pembayaran
                    const formData = new FormData(this); // Buat objek FormData dari form

                    console.log("Mengirim bukti pembayaran:");
                    console.log("ID:", id);
                    console.log("URL:", url);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData, // Kirim form data termasuk file
                        processData: false, // Jangan ubah data menjadi string
                        contentType: false, // Jangan atur tipe konten
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                location.reload(); // Reload halaman setelah berhasil
                            } else {
                                alert('Gagal: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseText);
                        }
                    });
                });

                // Handler untuk Konfirmasi Pembayaran
                $('#updateStatus').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const id = $('#edit_id_payment').val(); // Ambil ID pembayaran
                    const url = '/payment/' + id + '/confirm'; // Endpoint untuk konfirmasi pembayaran
                    const formData = $(this).serialize(); // Serialize data form

                    console.log("Mengonfirmasi pembayaran:");
                    console.log("ID:", id);
                    console.log("URL:", url);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData + '&_method=PUT', // Tambahkan method PUT ke data form
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                location.reload(); // Reload halaman setelah berhasil
                            } else {
                                alert('Gagal: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseText);
                        }
                    });
                });

            });
        </script>
    @endsection
