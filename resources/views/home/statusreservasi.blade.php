@extends('home.statusreservasi')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Status Reservasi
        </h2>

        @foreach ($reservations as $reservasi)
            <div class="flex justify-between items-center mb-6 bg-white p-6 rounded-lg shadow">
                <!-- Informasi Utama -->
                <div class="w-1/3">
                    <h4 class="text-lg font-semibold mb-2">{{ $reservasi->user->name }}</h4>
                    <p class="text-gray-600">ID Reservasi: {{ $reservasi->id_reservation }}</p>
                    <p class="text-gray-600">Kamar: {{ $reservasi->room->name }}</p>
                    <p class="text-gray-600">Alamat: {{ $reservasi->room->address }}</p>
                </div>

                <!-- Progres Status Reservasi -->
                <div class="w-2/3">
                    <div class="relative">
                        <div class="absolute w-full bg-gray-200 h-1 top-1/2 transform -translate-y-1/2"></div>
                        <!-- Step 1 -->
                        <div class="flex items-center">
                            <div class="w-1/4 flex flex-col items-center relative">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center
                                    {{ $reservasi->reservation_status >= 1 ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                    <span class="font-bold">1</span>
                                </div>
                                <p class="text-xs mt-2">Diajukan</p>
                            </div>

                            <!-- Step 2 -->
                            <div class="w-1/4 flex flex-col items-center relative">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center
                                    {{ $reservasi->reservation_status >= 2 ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                    <span class="font-bold">2</span>
                                </div>
                                <p class="text-xs mt-2">Diterima</p>
                            </div>

                            <!-- Step 3 -->
                            <div class="w-1/4 flex flex-col items-center relative">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center
                                    {{ $reservasi->reservation_status == 0 ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
                                    <span class="font-bold">3</span>
                                </div>
                                <p class="text-xs mt-2">Ditolak</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan & Aksi -->
                <div class="w-1/3 text-right">
                    <p class="text-gray-700 font-semibold">
                        Harga: Rp {{ number_format($reservasi->room->price_per_month, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-600">
                        Tanggal: {{ $reservasi->reservation_date }}
                    </p>

                    <!-- Status dengan Waktu Update -->
                    <div class="mt-2">
                        @if ($reservasi->reservation_status == 1)
                            <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full">
                                Diajukan
                            </span>
                        @elseif ($reservasi->reservation_status == 2)
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Diterima
                            </span>
                        @elseif ($reservasi->reservation_status == 0)
                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                Ditolak
                            </span>
                        @endif

                        @if ($reservasi->status_updated_at)
                            <p class="text-xs text-gray-500 mt-1">
                                Diperbarui pada: {{ \Carbon\Carbon::parse($reservasi->status_updated_at)->format('d M Y H:i') }}
                            </p>
                        @endif
                    </div>

                    <!-- Tombol Aksi untuk Owner -->
                    @can('owner')
                        <div class="mt-4">
                            @if ($reservasi->reservation_status == 2)
                                <button disabled
                                    class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg opacity-50">
                                    Sudah Diterima
                                </button>
                            @else
                                <!-- Terima Reservasi -->
                                <form action="{{ route('reservation.update', $reservasi->id_reservation) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="reservation_status" value="2">
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                                        Terima
                                    </button>
                                </form>

                                <!-- Tolak Reservasi -->
                                <form action="{{ route('reservation.update', $reservasi->id_reservation) }}" method="POST" class="mt-1">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="reservation_status" value="0">
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                                        Tolak
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
@endsection
