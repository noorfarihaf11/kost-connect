@extends('home.layouts.main')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Status Reservasi
        </h2>

        <!-- Link Navigasi -->
        <div class="flex justify-start space-x-4 mb-6">
            <a href="{{ route('status-reservasi.index', ['section' => 'pengajuan']) }}"
               class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-600">
                Pengajuan
            </a>
            <a href="{{ route('status-reservasi.index', ['section' => 'payment']) }}"
               class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-600">
                Payment
            </a>
        </div>

        @if($section === 'pengajuan')
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Pengajuan</h3>
            @foreach ($reservations as $reservasi)
                <!-- Card Container -->
                <div class="bg-white shadow-lg rounded-lg p-6 flex space-x-6 mb-6">
                    <!-- Timeline Section -->
                    <div class="w-1/4 flex flex-col items-center relative border-r-2 border-gray-300 pr-6">
                        <!-- Garis Timeline -->
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 h-full w-1 bg-gray-300"></div>

                        <!-- Step 1: Diajukan -->
                        <div class="relative mb-10 flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ $reservasi->reservation_status >= 1 ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold">Diajukan</p>
                                <p class="text-xs text-gray-500">{{ $reservasi->created_at->format('M d') }}</p>
                            </div>
                        </div>

                        <!-- Step 2: Diterima -->
                        <div class="relative mb-10 flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ $reservasi->reservation_status == 2 ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                <span class="font-bold">2</span>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold">Diterima</p>
                                <p class="text-xs text-gray-500">Est. {{ now()->addDays(1)->format('M d') }}</p>
                            </div>
                        </div>

                        <!-- Step 3: Ditolak -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ $reservasi->reservation_status == 0 ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
                                <span class="font-bold">3</span>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold">Ditolak</p>
                                <p class="text-xs text-gray-500">Est. {{ now()->addDays(2)->format('M d') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Utama -->
                    <div class="border-l-2 border-gray-300 pl-6 flex-1">
                        <h4 class="text-lg font-semibold mb-2">{{ $reservasi->room->name }}</h4>
                        <p class="text-gray-600">Tanggal Kunjung: {{ $reservasi->reservation_date }}</p>
                        <p class="text-gray-600">Alamat: {{ $reservasi->room->house->address }}</p>
                        <p class="text-gray-600">Notes: {{ $reservasi->notes }}</p>
                        <p class="text-gray-600 mb-4">Harga: Rp {{ number_format($reservasi->room->price_per_month, 0, ',', '.') }}</p>
                        
                        <div class="flex space-x-4 mt-6">
                            <!-- Tombol Aksi -->
                            @can('owner')
                                @if ($reservasi->reservation_status == 2)
                                    <button
                                        class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed"
                                        disabled>
                                        Sudah Diterima
                                    </button>
                                @else
                                    <button
                                        class="accReservation px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700"
                                        data-id="{{ $reservasi->id_reservation }}"
                                        data-reservation_status="{{ $reservasi->reservation_status }}">
                                        Terima
                                    </button>
                                @endif
                            @endcan

                            <!-- Tombol Tambahan -->
                            <button class="px-4 py-2 border text-gray-600 rounded-lg hover:bg-gray-100">Detail</button>
                            <button class="px-4 py-2 border text-red-500 rounded-lg hover:bg-red-50">Batalkan</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if($section === 'payment')
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Payment</h3>
            @foreach ($payments as $tagihan)
                <!-- Card Container -->
                <div class="bg-white shadow-lg rounded-lg p-6 flex space-x-6 mb-6">
                    <!-- Timeline Section -->
                    <div class="w-1/4 flex flex-col items-center relative border-r-2 border-gray-300 pr-6">
                        <!-- Garis Vertical -->
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 h-full w-1 bg-gray-300"></div>
                    
                        <!-- Status 1: Membayar -->
                        <div class="relative mb-10 flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ in_array($tagihan->payment_status, ['pending', 'waiting_for_confirmation', 'paid']) ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold {{ $tagihan->payment_status == 'pending' ? 'text-blue-500' : '' }}">Membayar</p>
                                <p class="text-xs text-gray-500">{{ $tagihan->created_at->format('M d') }}</p>
                            </div>
                        </div>
                    
                        <!-- Status 2: Menunggu Konfirmasi -->
                        <div class="relative mb-10 flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ in_array($tagihan->payment_status, ['waiting_for_confirmation', 'paid']) ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                <span class="font-bold">2</span>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold {{ $tagihan->payment_status == 'waiting_for_confirmation' ? 'text-blue-500' : '' }}">Konfirmasi</p>
                                <p class="text-xs text-gray-500">{{ $tagihan->updated_at ? $tagihan->updated_at->format('M d') : '-' }}</p>
                            </div>
                        </div>
                    
                        <!-- Status 3: Terbayar -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ $tagihan->payment_status == 'paid' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                                <span class="font-bold">3</span>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold {{ $tagihan->payment_status == 'paid' ? 'text-blue-500' : '' }}">Terbayar</p>
                                <p class="text-xs text-gray-500">{{ $tagihan->updated_at ? $tagihan->updated_at->format('M d, Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>                                                           
        
                    <!-- Informasi Utama -->
                    <div class="border-l-2 border-gray-300 pl-6 flex-1">
                        <h4 class="text-lg font-semibold mb-2">{{ $tagihan->reservation->room->name }}</h4>
                        <p class="text-gray-600">Tagihan : Rp {{ number_format($tagihan->total_amount, 0, ',', '.') }}</p>
                        <p class="text-gray-600">Via Pembayaran : {{ $tagihan->payment_method }}</p>
                        <p class="text-gray-600 mb-4">Tanggal Pembayaran : {{ $tagihan->updated_at ? $tagihan->updated_at->format('M d, Y') : '-' }}</p>
        
                        <div class="flex space-x-4 mt-6">
                            <!-- Tombol Detail Pembayaran -->
                            <button
                                class="detailPaymentButton px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                                data-id="{{ $tagihan->id_payment }}"
                                data-id_reservation="{{ $tagihan->reservation->id_reservation }}"
                                data-name="{{ $tagihan->reservation->room->name }}"
                                data-payment_method="{{ $tagihan->payment_method }}"
                                data-total_amount="{{ $tagihan->total_amount }}"
                                data-proof_of_payment="{{ $tagihan->proof_of_payment }}">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        
    
            <!-- Modal -->
            <div id="paymentForm" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
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
                                    <label for="total_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tagihan</label>
                                    <input type="text" name="total_amount" id="total_amount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        readonly>
                                </div>
                                <div>
                                    <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Via Pembayaran</label>
                                    <input type="text" name="payment_method" id="payment_method"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        readonly>
                                </div>
                                <div id="uploadLabel" class="block">
                                    <label for="proof_of_payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Bukti Pembayaran</label>
                                    <input type="file" name="proof_of_payment" id="proof_of_payment"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                                </div>
                                <img id="proofImagePreview" class="hidden w-full h-auto rounded-lg" src="" alt="Bukti Pembayaran">
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
            </div>
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

@endsection
