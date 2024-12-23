@extends('home.layouts.main')

@section('content')
    <div class=" px-2 mx-auto max-w-screen-l lg:px-3">
        <a href="/home"
            class="inline-flex items-center font-medium text-black-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
            <svg class="ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M12.707 14.707a1 1 0 010-1.414L9.414 10l3.293-3.293a1 1 0 10-1.414-1.414l-4 4a1 1 0 000 1.414l4 4a1 1 0 001.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            Kembali
        </a>
    </div>
    <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
        <h2 class="my-6 text-3xl font-bold text-gray-800 dark:text-gray-200">
            {{ $section === 'payment' ? 'Pembayaran' : 'Reservasi' }}
        </h2>
        <div class="flex flex-col sm:flex-row justify-start space-x-0 sm:space-x-4 space-y-2 sm:space-y-0 mb-6">
            <a href="{{ route('status-reservasi.index', ['section' => 'pengajuan']) }}"
                class="w-full sm:w-auto text-center px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 transition
                {{ Request::is('status-reservasi*') && Request::get('section') == 'pengajuan' ? 'bg-blue-700 font-bold' : '' }}">
                Reservasi
            </a>
            <a href="{{ route('status-reservasi.index', ['section' => 'payment']) }}"
                class="w-full sm:w-auto text-center px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 transition
                {{ Request::is('status-reservasi*') && Request::get('section') == 'payment' ? 'bg-blue-700 font-bold' : '' }}">
                Pembayaran
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
                        <h4 class="text-xl font-bold text-gray-800">{{ $reservasi->room->name }}</h4>

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
                        <h4 class="text-xl font-bold text-gray-800 mb-1">{{ $tagihan->reservation->room->name }}</h4>
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
                        @if ($tagihan->payment_status == 'paid')
                            @if ($tagihan->payment_type == 'first_payment')
                                <p class="text-green-600 text-l mb-4 font-semibold">Selamat! Anda sudah resmi menjadi
                                    penghuni {{ $tagihan->reservation->room->name }}.</p>
                            @elseif ($tagihan->payment_type == 'monthly_payment')
                                <p class="text-green-600 text-l mb-4 font-semibold">Terimakasih Anda telah membayar tagihan
                                    bulan {{ \Carbon\Carbon::parse($tagihan->payment_period)->translatedFormat('F') }}.</p>
                            @endif
                        @elseif ($tagihan->reservation->customer == null)
                            <button class="pay-button bg-blue-600 text-white px-4 py-2 rounded"
                                data-id-payment="{{ $tagihan->id_payment }}"
                                data-id-reservation="{{ $tagihan->id_reservation }}"
                                data-total-amount="{{ $tagihan->total_amount }}"
                                data-name="{{ $tagihan->reservation->user->name }}"
                                data-email="{{ $tagihan->reservation->user->email }}"
                                data-phone="{{ $tagihan->reservation->phone_number }}"
                                data-room="{{ $tagihan->reservation->room->name }}">
                                Bayar
                            </button>
                        @elseif ($tagihan->reservation->customer->customer_status == 'active')
                            <button class="pay-button bg-blue-600 text-white px-4 py-2 rounded"
                                data-id-payment="{{ $tagihan->id_payment }}"
                                data-id-reservation="{{ $tagihan->id_reservation }}"
                                data-total-amount="{{ $tagihan->total_amount }}"
                                data-name="{{ $tagihan->reservation->user->name }}"
                                data-email="{{ $tagihan->reservation->user->email }}"
                                data-phone="{{ $tagihan->reservation->phone_number }}"
                                data-room="{{ $tagihan->reservation->room->name }}">
                                Bayar
                            </button>
                            <button class="cancel-button bg-red-600 text-white px-4 py-2 rounded"
                                data-id-reservation="{{ $tagihan->id_reservation }}"
                                data-id_customer="{{ $tagihan->reservation->customer->id_customer }}"
                                data-customer_status="{{ $tagihan->reservation->customer->customer_status }}">
                                Berhenti kos
                            </button>
                        @else
                            <p class="text-red-600 text-l mb-4 font-semibold">Anda tidak menjadi penghuni kost ini lagi.</p>
                            @if ($tagihan->reservation->customer->customer_status === 'inactive')
                                <!-- Cek apakah pengguna sudah memberikan review -->
                                @php
                                    $existingReview = \App\Models\RoomReview::where('id_room', $room->id_room)
                                        ->where('id_customer', Auth::id())
                                        ->first();
                                @endphp

                                @if (!$existingReview)
                                    <!-- Tombol Review Muncul -->
                                    <button class="bg-purple-600 text-white px-4 py-2 rounded"
                                            onclick="showReviewForm({{ $room->id_room }})">
                                        Beri Review
                                    </button>
                                @else
                                    <p class="text-green-600 text-sm mt-2">Anda sudah memberikan review untuk kamar ini.</p>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>

                @foreach ($rooms as $room)
                    <div id="reviewForm-{{ $room->id_room }}" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg w-11/12 sm:w-1/3">
                            <form action="{{ route('rooms.review.store', $room->id_room) }}" method="POST">
                                @csrf
                                <div class="p-4">
                                    <label for="rating-{{ $room->id_room }}" class="block text-sm font-medium text-gray-700">Rating (1-5):</label>
                                    <div class="flex items-center space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star-{{ $room->id_room }}-{{ $i }}" name="rating" value="{{ $i }}" class="hidden" />
                                            <label for="star-{{ $room->id_room }}-{{ $i }}" class="star cursor-pointer text-gray-400 hover:text-yellow-500 text-2xl">&#9733;</label>
                                        @endfor
                                    </div>

                                    <label for="review-{{ $room->id_room }}" class="block mt-4 text-sm font-medium text-gray-700">Review:</label>
                                    <textarea name="review" id="review-{{ $room->id_room }}" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                                </div>

                                <div class="flex justify-end p-4 border-t">
                                    <button type="button" onclick="hideReviewForm({{ $room->id_room }})" class="px-4 py-2 text-sm font-medium text-gray-700 bg-red-200 rounded-lg">
                                        Batal
                                    </button>
                                    <button type="submit" class="ml-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div id="berhentiForm" style="display: none;"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-11/12 sm:w-1/3">
                        <form id="berhentiKos" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_customer" id="edit_id_customer">
                            <input type="hidden" name="customer_status" id="edit_customer_status" value="inactive">
                            <div class="flex justify-between items-center p-4 border-b">
                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Berhenti kos</h2>
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
                                    Apakah anda yakin untuk tidak memperpanjang kos ini? Dengan menyetujui, status anda
                                    sebagai penghuni kos sudah tidak aktif
                                </p>
                            </div>

                            <div class="flex justify-end p-4 border-t">
                                <button id="rejectButton" type="button"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-red-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    Batal
                                </button>

                                <button id="acceptButton" type="button"
                                    class="ml-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">
                                    Setuju
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <style>
        .star {
            font-size: 2rem; /* Ukuran bintang */
            color: gray; /* Warna bintang default */
            cursor: pointer; /* Menambahkan cursor pointer untuk menunjukkan elemen yang dapat diklik */
        }

        .star:hover {
            color: #f59e0b; /* Warna kuning ketika dihover */
        }

        input[type="radio"]:checked ~ label.star {
            color: #f59e0b; /* Warna bintang yang dipilih */
        }

        input[type="radio"]:checked ~ label.star:hover {
            color: #f59e0b; /* Warna kuning saat bintang dihover, meskipun sudah dipilih */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery -->
    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('.cancel-button').click(function() {
                const id = $(this).data('id_customer');
                const customer_status = $(this).data('customer_status');

                $('#edit_id_customer').val(id);
                $('#edit_customer_status').val(customer_status);

                $('#berhentiForm').show(); // Open the modal
            });

            $('#closeModalButton').click(function() {
                $('#berhentiForm').hide(); // Hide the modal
            });

            $('#acceptButton').click(function() {
                $('#edit_customer_status').val('inactive'); // Set reservation_status menjadi 2 (Terima)
                $('#berhentiKos').submit(); // Kirim form
            });

            $('#rejectButton').click(function() {
                $('#edit_customer_status').val('active'); // Set reservation_status menjadi 3 (Tolak)
                $('#berhentiKos').submit(); // Kirim form
            });

            $('#berhentiKos').on('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secara default

                const id = $('#edit_id_customer').val(); // Ambil ID dari input tersembunyi
                const url = '/customer/' + id; // URL untuk permintaan PUT
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
                            alert(
                                'Pengajuan berhasil, Anda sudah tidak menjadi penghuni kost ini');
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

    <script>
        function showReviewForm(roomId) {
        document.getElementById('reviewForm-' + roomId).style.display = 'block';
    }

    function hideReviewForm(roomId) {
        document.getElementById('reviewForm-' + roomId).style.display = 'none';
    }
    
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('for').split('-')[2]; 
            console.log(`Rating selected: ${rating}`); 
        });
    });
    </script>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-I485cPfrefIvToXk"></script>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('pay-button')) {
                const button = event.target;
                const id_payment = button.getAttribute('data-id-payment');
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
                            id_payment: id_payment,
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
