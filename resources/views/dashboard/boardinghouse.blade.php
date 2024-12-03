@extends('dashboard.layouts.main')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container grid px-6 mx-auto">
        @if (Gate::allows('admin'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Rumah Kost</h2>
        @elseif (Gate::allows('owner'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Rumah Kost Saya</h2>
        @endif

        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Daftar Rumah Kost</h4>
            <button type ="button"
                class=" addHouseButton px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Tambah rumah
            </button>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($houses as $rumah)
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-md hover:shadow-lg transition-shadow dark:border-gray-700 dark:bg-gray-800">
                    <!-- Image Section -->
                    <div class="h-40 overflow-hidden rounded-lg">
                        <a href="#">
                            <img class="w-full h-full object-cover"
                                src="{{ asset('storage/' . $rumah->image) }}"
                                alt="{{ $rumah->name }}">
                        </a>
                    </div>
        
                    <div class="pt-4">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white hover:underline">
                            {{ $rumah->name }}
                        </h5>
        
                        <p class="text-sm text-gray-700 dark:text-gray-400">
                            <strong>Pemilik:</strong> {{ $rumah->owner->name }} | {{ $rumah->owner->phone }}
                        </p>
        
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            <strong>Lokasi:</strong> {{ $rumah->address }}, {{ $rumah->city->name_city }}
                        </p>
        
                        <div class="mt-4 flex items-center justify-between">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full 
                                {{ $rumah->gender_type === 'putra' ? 'bg-blue-600' : ($rumah->gender_type === 'putri' ? 'bg-pink-600' : 'bg-orange-600') }}">
                                {{ ucfirst($rumah->gender_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        

        <div id="addHouseForm" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambahkan rumah kost
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
                    <form action="/submitHouseForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Rumah
                                    Kost</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan nama kostan" required="">
                            </div>
                            <div>
                                <label for="name_city"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
                                <select name="id_city" id="name_city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled selected>Pilih Kota</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id_city }}">{{ $city->name_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <input type="text" name="address" id="address"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Alamat kostan" required="">
                            </div>
                            <div>
                                <label for="gender_type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Gender</label>
                                <select name="gender_type" id="gender_type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                    <option value="" disabled selected>Pilih Tipe Gender</option>
                                    <option value="putra">Putra</option>
                                    <option value="putri">Putri</option>
                                    <option value="campur">Campur</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <div>
                                <label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Rumah</label>
                                @if (!empty($house->image))
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $house->image) }}" alt="Foto Rumah"
                                            class="max-w-full h-auto rounded-lg">
                                    </div>
                                @endif

                                <input type="file" name="image" id="image"
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Tambah rumah
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

            $('.addHouseButton').click(function() {

                $('#addHouseForm').removeClass('hidden');
            });

            $('#closeModalButton').click(function() {
                $('#addHouseForm').addClass('hidden');
            });
        });

        $(document).ready(function() {
            $('#houseForm').submit(function(e) {
                e.preventDefault(); // 
                
                var formData = new FormData(this);

                $.ajax({
                    url: '/submitHouseForm', // Pastikan action form sesuai dengan URL
                    method: 'POST',
                    data: formData,
                    processData: false, // Jangan proses data
                    contentType: false, // Jangan set contentType
                    success: function(response) {
                        alert('Rumah berhasil ditambahkan!');
                        // Anda bisa menambahkan kode untuk memperbarui UI atau mengarahkan kembali
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan: ' + error.responseText);
                    }
                });
            });
        });
    </script>
@endsection
