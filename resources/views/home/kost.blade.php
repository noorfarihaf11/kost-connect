@extends('home.layouts.main')

@section('content')
<section class="bg-gray-50 py-6 antialiased dark:bg-gray-900">
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <div class="mx-auto max-w-screen-xl px-4 lg:px-0">

            <div class="mb-8 flex items-center justify-between">
                <h2 id="heading" class="mt-3 text-2xl font-bold text-gray-900 dark:text-white">Semua kost di Kost Connect</h2>
    
                <button id="filterToggle" type="button" class="relative flex items-center rounded bg-primary-700 px-5 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Filter
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
    
            <div id="filterOptions" class="hidden absolute right-0 mt-2 w-64 rounded-lg border border-gray-200 bg-white p-4 shadow-lg dark:border-gray-700 dark:bg-gray-800">

                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pilih Kota</h3>
                    <div class="space-y-2">
                        @if ($rooms->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada data</p>
                        @else
                            @foreach ($rooms->groupBy('house.city.name_city') as $cityName => $roomsByCity)
                                @if (!empty($cityName))
                                <div class="flex items-center">
                                    <input type="checkbox" id="city-{{ $cityName }}" class="city-filter h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" value="{{ $cityName }}">
                                    <label for="city-{{ $cityName }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $cityName }}</label>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
    

                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pilih Jenis Kos</h3>
                    <div class="space-y-2">
                        @if ($rooms->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada data</p>
                        @else
                            @foreach ($rooms->groupBy('house.gender_type') as $genderType => $roomsByGender)
                                @if (!empty($genderType))
                                <div class="flex items-center">
                                    <input type="checkbox" id="gender-{{ $genderType }}" class="gender-filter h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" value="{{ $genderType }}">
                                    <label for="gender-{{ $genderType }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ ucfirst($genderType) }}</label>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
    

                <button id="applyFilters" type="button" class="w-full rounded bg-primary-700 px-5 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Terapkan
                </button>
        </div>


            <div id="room-list" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($rooms as $room)
                <div class="group rounded-lg border border-gray-200 bg-white shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl dark:border-gray-700 dark:bg-gray-800 room-card" 
                     data-city="{{ $room->house?->city?->name_city }}" 
                     data-gender="{{ $room->house?->gender_type }}">
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
                            <span class="inline-block rounded-full px-3 py-1 text-xs font-medium 
                                @if (isset($room->house) && $room->house->gender_type == 'putra') 
                                bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                @elseif (isset($room->house) && $room->house->gender_type == 'putri') 
                                bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300
                            @else
                                bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300
                            @endif">
                                {{ $room->house->gender_type ?? 'Tidak Tersedia' }}
                        </span>
                    </div>                    
                    <a href="#" class="block mb-2 text-lg font-semibold text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-300">
                        {{ $room->name }}
                    </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $room->description }}</p>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <ul class="space-y-1">
                                <li><span class="font-medium text-gray-700 dark:text-gray-300">Kamar Tersedia:</span> {{ $room->available_rooms ?? 'Tidak Tersedia' }} kamar</li>
                                <li><span class="font-medium text-gray-700 dark:text-gray-300">Luas:</span> {{ $room->square_feet ?? 'Tidak Tersedia' }} m<sup>2</sup></li>
                                <li><span class="font-medium text-gray-700 dark:text-gray-300">Kota:</span> {{ $room->house->city->name_city ?? 'Tidak Tersedia' }}</li>
                        </ul>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <p class="text-xl font-bold text-gray-900 dark:text-white">
                                Rp {{ number_format($room->price_per_month ?? 0, 0, ',', '.') }}
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

        <script>
            $(document).ready(function () {

                $('#filterToggle').on('click', function () {
                    const offset = $(this).offset();
                    const height = $(this).outerHeight();
                    $('#filterOptions').css({
                        top: offset.top + height,
                        left: offset.left - ($('#filterOptions').outerWidth() - $(this).outerWidth())
                    }).toggle();
   
                });
    
                function updateHeading() {
                    const selectedCities = $('.city-filter:checked').map(function () {
                        return $(this).val();
                    }).get();
    
                    const selectedGenders = $('.gender-filter:checked').map(function () {
                        return $(this).val();
                    }).get();
    
                    let cityText = selectedCities.length > 0 ? selectedCities.join(' & ') : '';
                    let genderText = selectedGenders.length > 0 ? selectedGenders.join(' & ') : '';
    
                    let headingText = 'Semua kost';
    
                    if (cityText) headingText += ` ${cityText}`;
                    if (genderText) headingText += ` ${genderText}`;
    
                    headingText += ' di Kost Connect';
    
                    $('#heading').text(headingText);
                }
    
                function filterRooms() {
                    const selectedCities = $('.city-filter:checked').map(function () {
                        return $(this).val();
                    }).get();
    
                    const selectedGenders = $('.gender-filter:checked').map(function () {
                        return $(this).val();
                    }).get();
    
                    $('.room-card').each(function () {
                        const roomCity = $(this).data('city');
                        const roomGender = $(this).data('gender');
    
                        if (
                            (selectedCities.length === 0 || selectedCities.includes(roomCity)) &&
                            (selectedGenders.length === 0 || selectedGenders.includes(roomGender))
                        ) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }

                $('#applyFilters').on('click', function () {
                    filterRooms();
                    updateHeading();
                    
                    const selectedCount = $('.city-filter:checked').length + $('.gender-filter:checked').length;
                    const filterText = selectedCount > 0 ? `Filter (${selectedCount})` : 'Filter';
                    
                    $('#filterToggle').html(`${filterText} <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>`);
                    $('#filterOptions').hide();
                });
            });
        </script>
    </section>    

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
