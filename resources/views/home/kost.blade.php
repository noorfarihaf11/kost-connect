@extends('home.layouts.main')

@section('content')
<section class="bg-gray-50 py-6 antialiased dark:bg-gray-900">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="mx-auto max-w-screen-xl px-4 lg:px-0">
        <!-- Breadcrumb & Heading -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 rtl:space-x-reverse">
                    <li>
                        <a href="#" class="text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white flex items-center">
                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M19.707 9.293l-2-2-7-7a1 1 0 00-1.414 0l-7 7-2 2a1 1 0 001.414 1.414L2 10.414V18a2 2 0 002 2h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a2 2 0 002-2v-7.586l.293.293a1 1 0 001.414-1.414z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <span class="text-gray-500 dark:text-gray-400 mx-2">/</span>
                        <a href="#" class="text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">Kamar Kost</a>
                    </li>
                    <li>
                        <span class="text-gray-500 dark:text-gray-400 mx-2">/</span>
                        <span class="text-gray-500 dark:text-gray-400">Surabaya</span>
                    </li>
                </ol>
            </nav>
            <h2 class="mt-3 text-2xl font-bold text-gray-900 dark:text-white">Kost Daerah Surabaya</h2>
        </div>

        <!-- Room Cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($rooms as $room)
            <div class="group rounded-lg border border-gray-200 bg-white shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl dark:border-gray-700 dark:bg-gray-800">
                <div class="h-56 w-full overflow-hidden rounded-t-lg">
                    <a href="#">
                        <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105 dark:hidden" 
                             src="{{ asset('storage/' . $room->image) }}" 
                             alt="{{ $room->name }}" />
                        <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105 hidden dark:block" 
                             src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" 
                             alt="{{ $room->name }}" />
                    </a>
                </div>
                <div class="p-4">
                    <div class="mb-4 flex items-center justify-between">
                        <span 
                            class="inline-block rounded-full px-3 py-1 text-xs font-medium 
                            @if ($room->house->gender_type == 'putra') 
                                bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                            @elseif ($room->house->gender_type == 'putri') 
                                bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300
                            @else
                                bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300
                            @endif">
                            {{ $room->house->gender_type }}
                        </span>
                    </div>                    
                    <a href="#" class="block mb-2 text-lg font-semibold text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-300">
                        {{ $room->name }}
                    </a>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $room->description }}
                    </p>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <ul class="space-y-1">
                            <li>
                                <span class="font-medium text-gray-700 dark:text-gray-300">Kamar Tersedia:</span> 
                                {{ $room->available_rooms }} kamar
                            </li>
                            <li>
                                <span class="font-medium text-gray-700 dark:text-gray-300">Luas:</span> 
                                {{ $room->square_feet }} m<sup>2</sup>
                            </li>
                            <li>
                                <span class="font-medium text-gray-700 dark:text-gray-300">Kota:</span> 
                                {{ $room->house->city->name_city }}
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <p class="text-xl font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format($room->price_per_month, 0, ',', '.') }}
                        </p>
                        <button type="button" 
                                class="reservButton inline-flex items-center rounded bg-primary-700 px-5 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                data-id="{{ $room->id_room }}" 
                                data-name="{{ $room->name }}">
                            Reservasi
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


        <!-- Main modal -->
        <div id="reservationForm" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Ajukan Reservasi
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
                    <form action="/submitreservation" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="id_room"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kamar</label>
                                <input type="number" name="id_room" id="id_room"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    readonly>
                            </div>
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    readonly>
                            </div>
                            <div>
                                <label for="reservation_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                    Reservasi</label>
                                <input type="date" name="reservation_date" id="reservation_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div>
                                <label for="phone_number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan no hp aktif" required="">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <div>
                                <label for="notes"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                                <textarea name="notes" id="notes" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Tuliskan catatan reservasi di sini" required></textarea>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit"
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

                $('.reservButton').click(function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');

                    // Mengisi nilai ID kamar dan nama kamar ke dalam input
                    $('#id_room').val(id);
                    $('#name').val(name);

                    // Menampilkan modal
                    $('#reservationForm').removeClass('hidden');
                });

                $('#closeModalButton').click(function() {
                    $('#reservationForm').addClass('hidden');
                });

            });

            $('form').submit(function(e) {
                e.preventDefault(); // Mencegah form disubmit otomatis

                const formData = $(this).serialize(); // Ambil semua data dari form

                $.ajax({
                    url: '/submitreservation', // Pastikan action form sesuai dengan URL
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Reservasi berhasil!');
                        // Tindakan setelah berhasil
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan.');
                        // Tindakan error
                    }
                });
            });
        </script>
    @endsection
