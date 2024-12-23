@extends('home.layouts.main')

@section('content')
    <section class="relative bg-gradient-to-r from-blue-500 via-teal-500 to-green-500 text-white">
        <!-- Background image with parallax effect -->
        <div id="home" class="absolute inset-0 bg-cover bg-center opacity-50"
            style="background-image: url('https://i.pinimg.com/736x/4a/70/f4/4a70f405a23e39c21903499e2f00a47e.jpg'); filter: blur(2px);">
        </div>

        <!-- Content section -->
        <div class="relative z-10 grid max-w-screen-xl px-6 py-20 mx-auto lg:grid-cols-12 gap-8 items-center">
            <!-- Left content -->
            <div class="lg:col-span-7 space-y-6">
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight leading-tight">
                    Kost Connect
                </h1>
                <p class="text-lg md:text-xl font-light text-gray-200">
                    Temukan kos yang nyaman, terjangkau, dan strategis sesuai dengan kebutuhan Anda di Kost Connect.
                </p>
                <div class="flex space-x-4">
                    <a href="#kost"
                        class="px-8 py-3 text-lg font-semibold text-white bg-blue-600 rounded-lg shadow-lg transform transition-all duration-300 hover:scale-105 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Mulai
                    </a>
                    <a href="#about"
                        class="px-8 py-3 text-lg font-semibold text-blue-600 bg-white rounded-lg shadow-lg transform transition-all duration-300 hover:scale-105 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300">
                        Lihat selengkapnya
                    </a>
                </div>
            </div>

            <!-- Right content -->
            <div class="hidden lg:col-span-5 lg:flex justify-center">
                <div class="relative group">
                    <img src="https://i.pinimg.com/736x/4a/70/f4/4a70f405a23e39c21903499e2f00a47e.jpg" alt="mockup"
                        class="rounded-lg shadow-2xl transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-70 transition duration-500">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id ="about" class="bg-white dark:bg-gray-900 py-14">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center">
            <dl class="grid max-w-screen-md gap-8 mx-auto sm:grid-cols-3 text-gray-900 dark:text-white">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold count-up" data-target="1500">1,500+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">Kos Terdaftar</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold count-up" data-target="10000">10K+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">Pengguna Aktif</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold count-up" data-target="50">50+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">Kota Terjangkau</dd>
                </div>
            </dl>
        </div>
        <div class="max-w-screen-xl px-4 mx-auto text-center">
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition transform duration-500">
                    <img src="https://i.pinimg.com/736x/8e/6e/96/8e6e96db6d77cdc8d0b6d59bb78029f1.jpg"
                        alt="Fasilitas Lengkap" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="mb-2 text-xl font-bold">Fasilitas Lengkap</h3>
                    <p>Temukan kos dengan fasilitas seperti Wi-Fi, AC, parkir, dan keamanan 24 jam.</p>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition transform duration-500">
                    <img src="https://i.pinimg.com/736x/3c/07/9e/3c079efaaa9564266ccf8c9a39925d72.jpg"
                        alt="Lokasi Strategis" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="mb-2 text-xl font-bold">Lokasi Strategis</h3>
                    <p>Pilih kos yang dekat dengan kampus, pusat belanja, atau kantor anda.</p>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition transform duration-500">
                    <img src="http://www.savingadvice.com/wp-content/uploads/2017/08/saving-money-each-paycheck-.jpg"
                        alt="Harga Terjangkau" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="mb-2 text-xl font-bold">Harga Terjangkau</h3>
                    <p>Pilih kos sesuai anggaran anda tanpa mengorbankan kenyamanan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="kota" class="bg-white dark:bg-gray-900 py-14">
        <div class="max-w-screen-xl px-6 mx-auto text-center">
            <div class="mb-12">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Area Kos Terpopuler</h2>
                <p class="text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                    Temukan kos yang nyaman, terjangkau, dan strategis sesuai dengan kebutuhan anda di Kost Connect.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-8">
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://wallpaperaccess.com/full/2043838.jpg" alt="Kos Yogyakarta"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Yogyakarta</h3>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://www.planetware.com/wpimages/2020/06/indonesia-jakarta-top-things-to-do-visit-relax-merdeka-square.jpg"
                        alt="Kos Jakarta"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Jakarta</h3>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="http://www.indonesia-tourism.com/west-java/images/bandung.jpg" alt="Kos Bandung"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Bandung</h3>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://www.silverkris.com/wp-content/uploads/2017/11/Suroboyo-Monument.jpg"
                        alt="Kos Surabaya"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Surabaya</h3>
                    </div>
                </div>
                <!-- Add More Cities -->
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://www.oyorooms.com/travel-guide/id/wp-content/uploads/sites/6/2022/10/7-Wisata-Sejarah-di-Semarang-Bikin-Nostalgia.jpg"
                        alt="Kos Semarang"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Semarang</h3>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://www.jurnalasia.com/wp-content/uploads/2014/06/Mesjid-RayaMedan-Sumatera-Utara-1.jpg"
                        alt="Kos Semarang"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Medan</h3>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://hitput.com/wp-content/uploads/2019/04/malang-kota-bunga-bersejarah_pesona.travel-1024x540.jpg"
                        alt="Kos Semarang"
                        class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h3 class="text-2xl font-semibold text-white">Malang</h3>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <a href="#kost"
                        class="inline-flex items-center px-4 py-1 text-md font-medium text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200 transition-all">
                        Lihat Semua
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div id="kost" class="py-4 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <div class=" px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="mb-8 flex items-center justify-between">
                <h2 id="kost-list" class="mt-3 text-2xl font-bold text-gray-900 dark:text-white">Semua kost di Kost
                    Connect</h2>
                <button id="filterToggle" type="button"
                    class="relative flex items-center rounded bg-primary-700 px-5 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Filter
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <div id="filterOptions"
                class="hidden absolute right-0 mt-2 w-64 rounded-lg border border-gray-200 bg-white p-4 shadow-lg dark:border-gray-700 dark:bg-gray-800">

                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pilih Kota</h3>
                    <div class="space-y-2">
                        @if ($rooms->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada data</p>
                        @else
                            @foreach ($rooms->groupBy('house.city.name_city') as $cityName => $roomsByCity)
                                @if (!empty($cityName))
                                    <div class="flex items-center">
                                        <input type="checkbox" id="city-{{ $cityName }}"
                                            class="city-filter h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                            value="{{ $cityName }}">
                                        <label for="city-{{ $cityName }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $cityName }}</label>
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
                                        <input type="checkbox" id="gender-{{ $genderType }}"
                                            class="gender-filter h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                            value="{{ $genderType }}">
                                        <label for="gender-{{ $genderType }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ ucfirst($genderType) }}</label>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>


                <button id="applyFilters" type="button"
                    class="w-full rounded bg-primary-700 px-5 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Terapkan
                </button>
            </div>

            <div id="room-list" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($rooms as $room)
                    <div class="group rounded-lg border border-gray-200 bg-white shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl dark:border-gray-700 dark:bg-gray-800 room-card"
                        data-city="{{ $room->house?->city?->name_city }}" data-gender="{{ $room->house?->gender_type }}">
                        <div class="h-56 w-full overflow-hidden rounded-t-lg">
                            <a href="#">
                                <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105 dark:hidden"
                                    src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" />
                                <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105 hidden dark:block"
                                    src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                    alt="{{ $room->name }}" />
                            </a>
                        </div>
                        <div class="p-4">
                            <div class="mb-4 flex items-center justify-between">
                                <span
                                    class="inline-block rounded-full px-3 py-1 text-xs font-medium 
                                            @if (isset($room->house) && $room->house->gender_type == 'putra') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @elseif (isset($room->house) && $room->house->gender_type == 'putri') 
                                            bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300
                                        @else
                                            bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300 @endif">
                                    {{ $room->house->gender_type ?? 'Tidak Tersedia' }}
                                </span>
                            </div>
                            <a href="#"
                                class="block mb-2 text-lg font-semibold text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-300">
                                {{ $room->name }}
                            </a>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $room->description }}</p>
                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                <ul class="space-y-1">
                                    <li><span class="font-medium text-gray-700 dark:text-gray-300">Kamar
                                            Tersedia:</span>
                                        {{ $room->available_rooms ?? 'Tidak Tersedia' }} kamar</li>
                                    <li><span class="font-medium text-gray-700 dark:text-gray-300">Luas:</span>
                                        {{ $room->square_feet ?? 'Tidak Tersedia' }} m<sup>2</sup></li>
                                    <li><span class="font-medium text-gray-700 dark:text-gray-300">Kota:</span>
                                        {{ $room->house->city->name_city ?? 'Tidak Tersedia' }}</li>
                                </ul>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-xl font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format($room->price_per_month ?? 0, 0, ',', '.') }}
                                </p>
                                <button type="button"
                                    class="reservButton inline-flex items-center rounded bg-primary-700 px-5 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                    data-id="{{ $room->id_room }}" data-name="{{ $room->name }}">
                                    Reservasi
                                </button>
                            </div>
                            <!-- Bagian review di sini -->
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Review</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Average Rating:
                                    <span class="text-primary-600 dark:text-primary-300 font-medium">
                                        {{ round($room->averageRating(), 1) ?? 'Belum ada rating' }}
                                    </span>
                                </p>
                                @if ($room->reviews->isEmpty())
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada review untuk kamar
                                        ini.</p>
                                @else
                                    @foreach ($room->reviews as $review)
                                        <div
                                            class="mt-4 p-4 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $review->customer->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Rating:
                                                {{ $review->rating }} <span class="text-yellow-500">&#9733;</span></p>
                                            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $review->review }}
                                            </p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#filterToggle').on('click', function() {
                const offset = $(this).offset();
                const height = $(this).outerHeight();
                $('#filterOptions').css({
                    top: offset.top + height,
                    left: offset.left - ($('#filterOptions').outerWidth() - $(this).outerWidth())
                }).toggle();

            });

            function updateHeading() {
                const selectedCities = $('.city-filter:checked').map(function() {
                    return $(this).val();
                }).get();

                const selectedGenders = $('.gender-filter:checked').map(function() {
                    return $(this).val();
                }).get();

                let cityText = selectedCities.length > 0 ? selectedCities.join(' & ') : '';
                let genderText = selectedGenders.length > 0 ? selectedGenders.join(' & ') : '';

                let headingText = 'Semua kost';

                if (genderText && cityText) {
                    headingText += '';
                }

                if (genderText) headingText += ` ${genderText} di Kost Connect`;

                if (cityText) headingText += ` di ${cityText}`;

                if (!genderText && !cityText) {
                    headingText += ' di Kost Connect';
                }

                $('#kost-list').text(headingText); // Mengupdate teks heading
            }


            function filterRooms() {
                const selectedCities = $('.city-filter:checked').map(function() {
                    return $(this).val();
                }).get();

                const selectedGenders = $('.gender-filter:checked').map(function() {
                    return $(this).val();
                }).get();

                $('.room-card').each(function() {
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

            $('#applyFilters').on('click', function() {
                filterRooms();
                updateHeading();

                const selectedCount = $('.city-filter:checked').length + $('.gender-filter:checked').length;
                const filterText = selectedCount > 0 ? `Filter (${selectedCount})` : 'Filter';

                $('#filterToggle').html(
                    `${filterText} <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>`
                );
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
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
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

                <form action="/submitreservation" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="id_room" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID
                                Kamar</label>
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
                            class="submitButton text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
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

        $('#submitButton').submit(function(e) {
            e.preventDefault(); // Mencegah form disubmit otomatis

            const formData = $(this).serialize(); // Ambil semua data dari form

            $.ajax({
                url: '/submitreservation', // Pastikan action form sesuai dengan URL
                method: 'POST',
                data: formData,
                success: function(response) {
                        if (response.success) {
                            alert(
                                'Reservasi berhasil, cek status reservasi kamu di Status Reservasi'
                            );
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
    </script>
@endsection
