@extends('dashboard.layouts.main')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container grid px-6 mx-auto">
        @if (Gate::allows('admin'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Kamar Kost</h2>
        @elseif (Gate::allows('owner'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Kamar Kost Saya</h2>
        @endif

        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Daftar Kamar Kost</h4>
            <button type ="button"
                class=" addRoomButton px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Tambah kamar
            </button>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($rooms as $room)
                <div
                    class="relative rounded-lg border border-gray-200 bg-white p-4 shadow-md hover:shadow-lg transition-shadow dark:border-gray-700 dark:bg-gray-800">

                    <div class="h-40 overflow-hidden rounded-lg">
                        <a href="#">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $room->image) }}"
                                alt="{{ $room->name }}">
                        </a>
                    </div>

                    <div class="pt-4">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white hover:underline">
                            {{ $room->name }}
                        </h5>

                        <p class="text-sm text-gray-700 dark:text-gray-400">
                            {{ $room->description }}
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            <strong>Harga:</strong> Rp {{ number_format($room->price_per_month, 0, ',', '.') }} / bulan
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            <strong>Luas:</strong> {{ $room->square_feet }} m²
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            <strong>Status:</strong>
                            <span class="{{ $room->is_available ? 'text-green-500' : 'text-red-500' }}">
                                {{ $room->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            <strong>Kamar Tersedia:</strong> {{ $room->available_rooms }}
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            <strong>Kota:</strong> 
                            @if(isset($room->house) && isset($room->house->city))
                                {{ $room->house->city->name_city }}
                            @else
                                <span class="text-gray-500">Tidak ada informasi kota</span>
                            @endif
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                @if($room->house)
                                    <span class="px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-100">
                                    {{ $room->house->name }}
                                </span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold text-gray-500">No house assigned</span>
                                @endif
                        
                                <span class="px-3 py-1 text-sm font-semibold text-white rounded-full 
                                    {{ ($room->house && $room->house->gender_type === 'putra') ? 'bg-blue-600' : 
                                       ($room->house && $room->house->gender_type === 'putri' ? 'bg-pink-600' : 'bg-orange-600') }}">
                                    {{ ucfirst($room->house ? $room->house->gender_type : 'unknown') }}
                                </span>
                            </div>
                            <button class="editRoomButton flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-700 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit" data-id="{{ $room->id_room }}" data-name="{{ $room->name }}"
                                data-id_house="{{ $room->id_house }}" data-price_per_month="{{ $room->price_per_month }}">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="addRoomForm" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambahkan kamar kost
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
                    <form action="/submitRoomForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama kamar</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan nama kamar" required="">
                            </div>
                            <div>
                                <label for="name_house"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rumah</label>
                                <select name="id_house" id="name_house"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled selected>Pilih Rumah</option>
                                    @foreach ($houses as $house)
                                        <option value="{{ $house->id_house }}">{{ $house->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="price_per_month"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per
                                    bulan</label>
                                <input type="text" name="price_per_month" id="price_per_month"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="ex : 650000" required="">
                            </div>
                            <div>
                                <label for="square_feet"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Luas kamar</label>
                                <input type="text" name="square_feet" id="square_feet"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="ex : 12" required="">
                            </div>
                            <div>
                                <label for="available_rooms"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar
                                    tersedia</label>
                                <input type="text" name="available_rooms" id="available_rooms"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="jumlah kamar tersedia" required="">
                            </div>
                            <div>
                                <label for="is_available"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ketersediaan
                                    kamar</label>
                                <select name="is_available" id="is_available"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                    <option value="" disabled selected>Status</option>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Penuh</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <div>
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                    kamar</label>
                                <textarea name="description" id="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Kamar nyaman dengan fasilitas lengkap" required></textarea>
                            </div>
                            <div>
                                <label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Rumah</label>
                                <input type="file" name="image" id="image"
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Tambah kamar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="editRoomForm" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit kamar kost
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            id="closeEditModalButton">
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
                    <form id="updateRoomForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_room" id="edit_id_room">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="edit_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    kamar</label>
                                <input type="text" name="name" id="edit_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div>
                                <label for="edit_price_per_month"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                    per bulan</label>
                                <input type="text" name="price_per_month" id="edit_price_per_month"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div>
                                <label for="edit_square_feet"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Luas
                                    kamar</label>
                                <input type="text" name="square_feet" id="edit_square_feet"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div>
                                <label for="edit_available_rooms"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar
                                    tersedia</label>
                                <input type="text" name="available_rooms" id="edit_available_rooms"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div>
                                <label for="edit_is_available"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ketersediaan
                                    kamar</label>
                                <select name="is_available" id="edit_is_available"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Penuh</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Update kamar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery -->
    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('.addRoomButton').click(function() {

                $('#addRoomForm').removeClass('hidden');
            });

            $('#closeModalButton').click(function() {
                $('#addRoomForm').addClass('hidden');
            });
        });

        $(document).ready(function() {
            $('#roomForm').submit(function(e) {
                e.preventDefault(); // 

                var formData = new FormData(this);

                $.ajax({
                    url: '/submitRoomForm', // Pastikan action form sesuai dengan URL
                    method: 'POST',
                    data: formData,
                    processData: false, // Jangan proses data
                    contentType: false, // Jangan set contentType
                    success: function(response) {
                        alert('Kamar berhasil ditambahkan!');
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan: ' + error.responseText);
                    }
                });
            });
        });
        $(document).on('click', '.editRoomButton', function() {
            const roomData = $(this).data();

            $('#edit_id_room').val(roomData.id);
            $('#edit_name').val(roomData.name);
            $('#edit_price_per_month').val(roomData.price_per_month);
            $('#edit_square_feet').val(roomData.square_feet);
            $('#edit_available_rooms').val(roomData.available_rooms);
            $('#edit_is_available').val(roomData.is_available);

            $('#editRoomForm').removeClass('hidden');
        });

        $('#closeEditModalButton').click(function() {
            $('#editRoomForm').addClass('hidden');
        });

        $('#updateRoomForm').submit(function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const roomId = $('#edit_id_room').val();

            $.ajax({
                url: `/rooms/${roomId}`,
                method: 'PUT',
                data: formData,
                success: function(response) {
                    alert('Data kamar berhasil diupdate!');
                    location.reload();
                },
                error: function(error) {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    </script>
@endsection
