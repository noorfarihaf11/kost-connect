@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Kost
        </h2>

        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Kamar kost
            </h4>
            <button id="openModal"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Kamar baru
            </button>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Kota</th>
                            <th class="px-4 py-3">Nama kamar</th>
                            <th class="px-4 py-3">Jenis kelamin</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Harga bulanan</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Luas kamar</th>
                            <th class="px-4 py-3">Jumlah tersedia</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($rooms as $room)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-sm text-center">{{ $room->id_room }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->city->name_city }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->name_room }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->room_type }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->description }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->price_per_month }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->address }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->square_feet }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $room->available_rooms }}</td>
                                <td class="px-4 py-3 text-sm text-center">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button
                                            class="editButton flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit"  data-id="{{ $room->id_room }}"
                                            data-name_room="{{ $room->name_room }}"
                                            data-room_type="{{ $room->room_type }}"
                                            data-description="{{ $room->description }}"
                                            data-price_per_month="{{ $room->price_per_month }}"
                                            data-address="{{ $room->address }}"
                                            data-square_feet="{{ $room->square_feet }}"
                                            data-available_rooms="{{ $room->available_rooms }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793z">
                                                </path>
                                                <path d="M11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </svg>
                                        </button>
                                        <button
                                            class="deleteButton flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete" data-id="{{ $room->id_room }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal untuk form New City -->
        <div id="cityForm" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Tambah kamar baru</h3>
                <form method="post" action="/rooms" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 flex space-x-4"> <!-- Menggunakan flex untuk dua kolom dalam satu baris -->
                        <div class="w-1/2">
                            <label class="block text-sm text-gray-700 dark:text-gray-400">Kota</label>
                            <select name="id_city" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300">
                                <option value="" disabled selected>Pilih Kota</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id_city }}">{{ $city->name_city }}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="w-1/2">
                            <label class="block text-sm text-gray-700 dark:text-gray-400">Nama kamar</label>
                            <input type="text" name="name_room" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                        </div>
                    </div>
        
                    <div class="mb-4 flex space-x-4"> <!-- Menggunakan flex untuk dua kolom dalam satu baris -->
                        <div class="w-1/2">
                            <label class="block text-sm text-gray-700 dark:text-gray-400">Jenis Kelamin</label>
                            <select name="room_type" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="putra">Putra</option>
                                <option value="putri">Putri</option>
                                <option value="campur">Campur</option>
                            </select>
                        </div>
        
                        <div class="w-1/2">
                            <label class="block text-sm text-gray-700 dark:text-gray-400">Harga Sewa</label>
                            <input type="text" name="price_per_month" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300"
                                placeholder="harga per bulan" />
                        </div>
                    </div>
                    <div class="mb-4 flex space-x-4"> <!-- Menggunakan flex untuk dua kolom dalam satu baris -->
                        <div class="w-1/2">
                            <label class="block text-sm text-gray-700 dark:text-gray-400">Luas Kamar</label>
                            <input type="text" name="square_feet" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                        </div>
        
                        <div class="w-1/2">
                            <label class="block text-sm text-gray-700 dark:text-gray-400">Jumlah Tersedia</label>
                            <input type="text" name="available_rooms" required
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 dark:text-gray-400">Deskripsi</label>
                        <input type="text" name="description" required
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 dark:text-gray-400">Alamat</label>
                        <input type="text" name="address" required
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                    </div>
                    <div class="flex justify-end">
                        <button id="closeModal" type="button"
                            class="px-4 py-2 mr-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-gray-200 border border-transparent rounded-md active:bg-gray-300 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    {{-- <!-- Modal untuk form Edit City -->
    <div id="editCityForm" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Add New City</h3>
            <form id="editCityDetails" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_city" id="edit_id_city">
                <div class="mb-4">
                    <label class="block text-sm text-gray-700 dark:text-gray-400">City Name</label>
                    <input type="text" name="name_city" id="edit_name_city" required
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-gray-700 dark:text-gray-400">Slug</label>
                    <input type="text" name="slug" id="edit_slug_city" required
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300" />
                </div>
                <div class="flex justify-end">
                    <button id="closeEditModal" type="button"
                        class="px-4 py-2 mr-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-gray-200 border border-transparent rounded-md active:bg-gray-300 focus:outline-none focus:shadow-outline-gray">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div> --}}

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButton = document.getElementById('openModal');
            const closeModalButton = document.getElementById('closeModal');
            const cityForm = document.getElementById('cityForm');


            openModalButton.addEventListener('click', function() {
                cityForm.style.display = 'flex';
            });

            closeModalButton.addEventListener('click', function() {
                cityForm.style.display = 'none';
            });

            const closeEditModalButton = document.getElementById('closeEditModal');
            const editCityForm = document.getElementById('editCityForm');

            closeEditModalButton.addEventListener('click', function() {
                editCityForm.style.display = 'none';
            });

        });
    
        $(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Edit button handler (untuk edit room)
    $('.editButton').click(function() {
        const id = $(this).data('id');
        const name_room = $(this).data('name_room');
        const room_type = $(this).data('room_type');
        const description = $(this).data('description');
        const price_per_month = $(this).data('price_per_month');
        const address = $(this).data('address');
        const square_feet = $(this).data('square_feet');
        const available_rooms = $(this).data('available_rooms');

        // Set the values in the edit form
        $('#edit_id_room').val(id);
        $('#edit_name_room').val(name_room);
        $('#edit_room_type').val(room_type);
        $('#edit_description').val(description);
        $('#edit_price_per_month').val(price_per_month);
        $('#edit_address').val(address);
        $('#edit_square_feet').val(square_feet);
        $('#edit_available_rooms').val(available_rooms);

        // Show the modal
        $('#editRoomForm').show(); // Open the modal
    });

    // Delete button handler (untuk delete room)
    $(document).on('click', '.deleteButton', function() {
        const id_room = $(this).data('id');
        const confirmed = confirm('Apakah Anda yakin ingin menghapus kamar ini?');

        if (confirmed) {
            $.ajax({
                url: '/rooms/' + id_room, // URL sesuai dengan route yang ditentukan
                type: 'DELETE',
                data: {
                    _token: csrfToken, // Mengirimkan CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert('Kamar berhasil dihapus!');
                        location.reload(); // Reload halaman setelah berhasil menghapus
                    } else {
                        alert('Error: ' + (response.message || 'Gagal menghapus kamar.'));
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menghapus kamar.');
                }
            });
        }
    });
});

    </script>
@endsection