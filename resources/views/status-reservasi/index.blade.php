@extends('home.layouts.main')

@section('content')
    <div class=" px-4 mx-auto max-w-screen-xl lg:px-6">
        <!-- Header -->
        <h2 class="my-6 text-3xl font-bold text-gray-800 dark:text-gray-200">
            {{ $section === 'payment' ? 'Pembayaran' : 'Reservasi' }}
        </h2>

        <!-- Navigasi Section -->
        <div class="flex flex-col sm:flex-row justify-start space-x-0 sm:space-x-4 space-y-2 sm:space-y-0 mb-6">
            <a href="{{ route('status-reservasi.index', ['section' => 'pengajuan']) }}"
                class="w-full sm:w-auto text-center px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 transition
                {{ Request::is('status-reservasi*') && Request::get('section') == 'pengajuan' ? 'bg-blue-700 font-bold' : '' }}">
                Pengajuan
            </a>
            <a href="{{ route('status-reservasi.index', ['section' => 'payment']) }}"
                class="w-full sm:w-auto text-center px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 transition
                {{ Request::is('status-reservasi*') && Request::get('section') == 'payment' ? 'bg-blue-700 font-bold' : '' }}">
                Payment
            </a>
        </div>

        @if ($section === 'pengajuan')
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Pengajuan</h3>
            @foreach ($reservations as $reservasi)
                <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 mb-6 flex flex-col md:flex-row">
                    <div class="w-full md:w-1/4 border-r-2 border-gray-300 pr-6 mb-4 md:mb-0 relative">
                        @foreach (['Diajukan', 'Diterima', 'Ditolak'] as $index => $status)
                            @php
                                $step = $index + 1;
                                if ($reservasi->reservation_status == 3 && $step == 3) {
                                    $statusClass = 'bg-red-500 text-white';
                                } elseif ($reservasi->reservation_status == 1 && $step == 1) {
                                    $statusClass = 'bg-yellow-500 text-white';
                                } elseif ($reservasi->reservation_status == 2 && $step == 2) {
                                    $statusClass = 'bg-green-500 text-white';
                                } else {
                                    $statusClass = 'bg-gray-200'; // Status yang belum tercapai
                                }
                            @endphp
                            <div class="flex items-center mb-8 relative">
                                @if ($step < 3)
                                    <div class="absolute left-4 top-8 h-full w-1 bg-gray-300 z-0"></div>
                                    <!-- Menambahkan z-index untuk memastikan garis berada di bawah -->
                                @endif
                                <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $statusClass }} z-10">
                                    <span class="font-bold text-white">{{ $step }}</span>
                                </div>
                                <div class="ml-6">
                                    <!-- Menambahkan margin kiri yang lebih besar untuk spasi lebih luas -->
                                    <p class="font-semibold">{{ $status }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if ($step == 1)
                                            {{ $reservasi->created_at->format('M d, Y h:i A') }} <!-- Diajukan -->
                                        @elseif ($step == 2 && $reservasi->reservation_status == 2)
                                            {{ $reservasi->updated_at->format('M d, Y h:i A') }} <!-- Diterima -->
                                        @elseif ($step == 3 && $reservasi->reservation_status == 3)
                                            {{ $reservasi->updated_at->format('M d, Y h:i A') }} <!-- Ditolak -->
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex-1 pl-0 md:pl-6 space-y-4">
                        <!-- Room Name -->
                        <h4 class="text-xl font-semibold text-gray-800">{{ $reservasi->room->name }}</h4>

                        <!-- Reservation Date -->
                        <p class="text-gray-600 text-sm">Tanggal Kunjung: <span
                                class="font-medium">{{ $reservasi->reservation_date }}</span></p>

                        <!-- Address -->
                        <p class="text-gray-600 text-sm">Alamat: <span
                                class="font-medium">{{ $reservasi->room->house->address }}</span></p>

                        <!-- Notes -->
                        <p class="text-gray-600 text-sm">Notes: <span class="font-medium">{{ $reservasi->notes }}</span>
                        </p>

                        <!-- Price -->
                        <p class="text-gray-600 font-medium text-sm mb-4">Harga: Rp
                            <span
                                class="font-bold">{{ number_format($reservasi->room->price_per_month, 0, ',', '.') }}</span>
                        </p>

                        <!-- Action Button -->
                        <div class="flex space-x-4 mt-4">
                            @can('owner')
                                @if ($reservasi->reservation_status == 2)
                                    <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed" disabled>
                                        Sudah Diterima
                                    </button>
                                @else
                                    <button
                                        class="accReservation px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition duration-300 ease-in-out"
                                        data-id="{{ $reservasi->id_reservation }}">
                                        Terima
                                    </button>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if ($section === 'payment')
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Payment</h3>
            @foreach ($payments as $tagihan)
                <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 mb-6 flex flex-col md:flex-row">
                    <div class="w-full md:w-1/4 border-r-2 border-gray-300 pr-6 mb-4 md:mb-0 relative">
                        @foreach (['Belum Bayar', 'Terbayar', 'Gagal'] as $index => $status)
                            @php
                                $step = $index + 1;
                                if ($tagihan->payment_status == 'pending' && $step == 1) {
                                    $statusClass = 'bg-yellow-500 text-white';
                                } elseif ($tagihan->payment_status == 'paid' && $step == 2) {
                                    $statusClass = 'bg-blue-500 text-white';
                                } elseif ($tagihan->payment_status == 'failed' && $step == 3) {
                                    $statusClass = 'bg-green-500 text-white';
                                } else {
                                    $statusClass = 'bg-gray-200';
                                }
                            @endphp
                            <div class="flex items-center mb-8 relative">
                                @if ($step < 3)
                                    <div class="absolute left-4 top-8 h-full w-1 bg-gray-300 z-0"></div>
                                @endif
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center {{ $statusClass }} z-10">
                                    <span class="font-bold text-white">{{ $step }}</span>
                                </div>
                                <div class="ml-6">
                                    <p class="font-semibold">{{ $status }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if ($step == 1)
                                            {{ $tagihan->created_at->format('M d, Y h:i A') }}
                                        @elseif ($step == 2 && $tagihan->payment_status == 'paid')
                                            {{ $tagihan->updated_at->format('M d, Y h:i A') }}
                                        @elseif ($step == 3 && $tagihan->payment_status == 'failed')
                                            {{ $tagihan->updated_at->format('M d, Y h:i A') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex-1 pl-0 md:pl-6 space-y-4">
                        <h4 class="text-xl font-semibold text-gray-800 mb-1">{{ $tagihan->reservation->room->name }}</h4>
                        <p class="text-gray-600 text-sm">Tagihan: <span class="font-medium">Rp
                                {{ number_format($tagihan->total_amount, 0, ',', '.') }}</span></p>

                        <p class="text-gray-600 text-sm mb-4">Tipe Pembayaran:
                            <span class="font-medium">
                                @if ($tagihan->payment_type == 'first_payment')
                                    Tagihan Pertama
                                @elseif($tagihan->payment_type == 'monthly_payment')
                                    Tagihan Bulanan
                                @else
                                    {{ $tagihan->payment_type }}
                                @endif
                            </span>
                        </p>
                        <p class="text-gray-600 text-sm">Jatuh Tempo:
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($tagihan->payment_due_date)->format('M d, Y') }}
                            </span>
                        </p>
                        <button class="pay-button bg-blue-600 text-white px-4 py-2 rounded" data-id ="{{ $tagihan->id_payment }}"
                            data-id-reservation ="{{ $tagihan->id_reservation }}"
                            data-total-amount="{{ $tagihan->total_amount }}" data-name="{{$tagihan->reservation->user->name}}"
                            data-email="{{$tagihan->reservation->user->email}}" data-phone="{{$tagihan->reservation->phone_number}}"
                            data-room="{{$tagihan->reservation->room->name}}">Bayar</button>
                    </div>
                </div>
            @endforeach
            <!-- Modal -->
            {{-- <div id="paymentForm" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Detail Tagihan
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                id="closeModalButton">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form id="kirimBukti" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_payment" id="edit_id_payment">
                            <div class="grid gap-4 mb-4">
                                <div>
                                    <label for="total_amount"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tagihan</label>
                                    <input type="text" name="total_amount" id="total_amount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        readonly>
                                </div>
                                <div>
                                    <label for="payment_method"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Via Pembayaran</label>
                                    <input type="text" name="payment_method" id="payment_method"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        readonly>
                                </div>
                                <div id="uploadLabel" class="block">
                                    <label for="proof_of_payment"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Bukti Pembayaran</label>
                                    <input type="file" name="proof_of_payment" id="proof_of_payment"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                                </div>
                                <img id="proofImagePreview" class="hidden w-full h-auto rounded-lg" src=""
                                    alt="Bukti Pembayaran">
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit"
                                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none">
                                    Kirim Bukti
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
        @endif
        

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery -->
        <script>
            $(document).ready(function() {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $('.detailPaymentButton, .seeButtonAdmin').click(function() {
                    const id = $(this).data('id');
                    const id_reservation = $(this).data('id_reservation');
                    const name = $(this).data('name');
                    const payment_method = $(this).data('payment_method');
                    const total_amount = $(this).data('total_amount');
                    const proof_of_payment = $(this).data('proof_of_payment');

                    // Mengisi nilai ke input form
                    $('#edit_id_payment').val(id);
                    $('#id_reservation').val(id_reservation);
                    $('#name').val(name);
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
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-I485cPfrefIvToXk"></script>
        <script>
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('pay-button')) {
                    const button = event.target;
                    const id = button.getAttribute('data-id');
                    const id_reservation = button.getAttribute('data-id-reservation');
                    const totalAmount = button.getAttribute('data-total-amount');
                    const name = button.getAttribute('data-name');
                    const email = button.getAttribute('data-email');
                    const phone = button.getAttribute('data-phone');
                    const room = button.getAttribute('data-room');

                    fetch('http://127.0.0.1:8000/api/midtrans/transaction', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id_reservation: id_reservation,
                                total_amount: totalAmount,
                                name: name,
                                email: email,
                                phone: phone,
                                room: room
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Data received:', data);
                            if (data.snap_token) {
                                snap.pay(data.snap_token); // Memulai pembayaran dengan Snap Token
                            } else {
                                alert('Gagal membuat transaksi');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan, coba lagi.');
                        });
                }
            });
        </script>
    @endsection
