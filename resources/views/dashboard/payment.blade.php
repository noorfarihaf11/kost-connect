@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        @if (auth()->check() && auth()->user()->id_role == 1)
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
                            <th class="px-4 py-3 text-center w-6">ID</th>
                            <th class="px-4 py-3 text-center w-6">ID Reservasi</th>
                            <th class="px-4 py-3">Kamar</th>
                            <th class="px-4 py-3">Tagihan</th>
                            <th class="px-4 py-3">Pembayaran Via</th>
                            <th class="px-4 py-3">Status</th>
                            @if (auth()->check() && auth()->user()->id_role == 1)
                                <th class="px-4 py-3">Lampiran</th>
                                <th class="px-4 py-3">Actions</th>
                            @else
                                <th class="px-4 py-3">Pembayaran</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($payments as $tagihan)
                            <tr class="text-gray-700 dark:text-gray-400 text-center">
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $tagihan->id_payment }}
                                </td>
                                <td class="px-3 py-2 text-sm w-6">
                                    {{ $tagihan->id_reservation }}
                                </td>
                                {{-- <td class="px-4 py-3">
                                    <div class="text-center">
                                        <p class="font-semibold">{{ $reservasi->user->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $reservasi->user->email }}
                                        </p>
                                    </div>
                                </td> --}}
                                <td class="px-4 py-3 text-sm">
                                    {{ $tagihan->reservation->room->name_room }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format($tagihan->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $tagihan->payment_method }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($tagihan->payment_status == 'pending')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Belum Bayar
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
                                    @if (auth()->check() && auth()->user()->id_role == 1)
                                        <button
                                            class="px-3 py-1 text-sm font-medium leading-5 text-white bg-blue-600 border border-transparent rounded-md transition-colors duration-150 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
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
                                <td>
                                    @if ($tagihan->payment_status == 'paid')
                                        <button
                                            class="px-4 py-2 text-sm font-medium leading-5 text-white bg-gray-400 border border-transparent rounded-md cursor-not-allowed"
                                            type="button" disabled>
                                            Terbayar
                                        </button>
                                    @elseif ($tagihan->payment_status == 'pending' && auth()->check() && auth()->user()->id_role == 1)
                                        <button
                                            class="accPayment px-3 py-1 text-sm font-medium leading-5 text-white bg-green-600 border border-transparent rounded-md transition-colors duration-150 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300"
                                            data-payment_status="{{ $tagihan->payment_status }}">
                                            Konfirmasi
                                        </button>
                                </td>
                        @endif
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </main>
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
                            <label for="id_reservation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID
                                Reservasi</label>
                            <input type="number" name="id_reservation" id="id_reservation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                readonly>
                        </div>
                        <div>
                            <label for="name_room"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar</label>
                            <input type="text" name="name_room" id="name_room"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                readonly>
                        </div>
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
                            <input id="proof_of_payment" name="proof_of_payment" type="file" class="hidden">
                            <div class="flex items-center justify-center w-full">
                                @if ($tagihan->proof_of_payment && file_exists(storage_path('app/public/payments/' . $tagihan->proof_of_payment)))
                                    <div
                                        class="w-full h-30 flex justify-left items-center bg-gray-50 border-2 border-dashed rounded-lg">
                                        <img src="{{ asset('storage/payments/' . $tagihan->proof_of_payment) }}"
                                            alt="Proof of Payment" class="max-w-40 h-40">
                                    </div>
                                @else
                                    <label for="proof_of_payment"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16v-1a4 4 0 014-4h2a4 4 0 014 4v1m-6 4a4 4 0 100-8 4 4 0 000 8zm0 0v.01">
                                                </path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Klik untuk mengunggah</span> atau tarik file
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, atau PDF (Max.
                                                2MB)
                                            </p>
                                        </div>
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button data-id="{{ $tagihan->id_payment }}"
                            data-proof_of_payment="{{ $tagihan->proof_of_payment }}"
                            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Kirim
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

            $('.detailPaymentButton').click(function() {
                const id = $(this).data('id');
                const id_reservation = $(this).data('id_reservation');
                const name_room = $(this).data('name_room');
                const payment_method = $(this).data('payment_method');
                const total_amount = $(this).data('total_amount');
                const proof_of_payment = $(this).data('proof_of_payment');

                // Mengisi nilai ID kamar dan nama kamar ke dalam input
                $('#edit_id_payment').val(id);
                $('#id_reservation').val(id_reservation);
                $('#name_room').val(name_room);
                $('#payment_method').val(payment_method);
                $('#total_amount').val(total_amount);
                $('#proof_display').text(proof_of_payment);

                // Menampilkan modal
                $('#paymentForm').removeClass('hidden');
            });

            $('#closeModalButton').click(function() {
                $('#paymentForm').addClass('hidden');
            });

        });

        $('#kirimBukti').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const id = $('#edit_id_payment').val();
            const url = '/payment/' + id; // Construct the URL for the PUT request
            const formData = new FormData(this); // Buat objek FormData dari form

            formData.append('_method', 'PUT'); // Tambahkan method PUT ke FormData

            console.log("Submitting data:");
            console.log("ID:", id);
            console.log("URL:", url);
            console.log("Form Data:", formData);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData, // Send the form data with CSRF token
                processData: false, // Jangan proses data menjadi string
                contentType: false, // Jangan atur tipe konten, browser akan mengatur secara otomatis
                success: function(response) {
                    if (response.success) {
                        alert('Kirim bukti berhasil!');
                        location.reload(); // Reload the page after a successful update
                    } else {
                        alert('Update failed: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr
                        .responseText); // Show error message if something goes wrong
                }
            });

            function previewImage() {
                const image = document.querySelector('#image');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        });
    </script>
@endsection
