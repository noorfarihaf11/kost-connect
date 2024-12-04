@extends('dashboard.layouts.main')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Edit Kamar</h2>

    <form action="{{ route('roomowner.update', $room->id_room) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input ID Room -->
        <input type="hidden" name="id_room" value="{{ $room->id }}">

        <!-- Nama Kamar -->
        <div class="mb-4">
            <label for="name_room" class="block text-sm font-medium text-gray-700">Nama Kamar</label>
            <input type="text" name="name_room" id="name_room" value="{{ $room->name_room }}" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Kota -->
        <div class="mb-4">
            <label for="id_city" class="block text-sm font-medium text-gray-700">Kota</label>
            <select name="id_city" id="id_city" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
                <option value="" disabled selected>Pilih Kota</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id_city }}" {{ $room->id_city == $city->id_city ? 'selected' : '' }}>
                        {{ $city->name_city }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-4">
            <label for="room_type" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select name="room_type" id="room_type" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
                <option value="putra" {{ $room->room_type == 'putra' ? 'selected' : '' }}>Putra</option>
                <option value="putri" {{ $room->room_type == 'putri' ? 'selected' : '' }}>Putri</option>
                <option value="campur" {{ $room->room_type == 'campur' ? 'selected' : '' }}>Campur</option>
            </select>
        </div>

        <!-- Harga Sewa -->
        <div class="mb-4">
            <label for="price_per_month" class="block text-sm font-medium text-gray-700">Harga Sewa</label>
            <input type="text" name="price_per_month" id="price_per_month" value="{{ $room->price_per_month }}" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Luas Kamar -->
        <div class="mb-4">
            <label for="square_feet" class="block text-sm font-medium text-gray-700">Luas Kamar (m²)</label>
            <input type="text" name="square_feet" id="square_feet" value="{{ $room->square_feet }}" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Jumlah Tersedia -->
        <div class="mb-4">
            <label for="available_rooms" class="block text-sm font-medium text-gray-700">Jumlah Tersedia</label>
            <input type="text" name="available_rooms" id="available_rooms" value="{{ $room->available_rooms }}" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <input type="text" name="description" id="description" value="{{ $room->description }}" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
            <input type="text" name="address" id="address" value="{{ $room->address }}" class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Foto Kamar</label>
            <input type="file" name="image" id="image" class="block w-full mt-1 p-2 border border-gray-300 rounded">
            @if ($room->image)
                <img src="{{ Storage::url($room->image) }}" alt="Room Image" class="mt-2 w-32 h-32 object-cover">
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Kamar</button>
        </div>
    </form>
</div>
@endsection
