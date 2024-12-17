@extends('home.layouts.main')

@section('content')

<!-- Hero Section with Parallax and Background Animation -->
<section class="relative bg-gradient-to-r from-blue-500 via-teal-500 to-green-500 text-white">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 parallax" style="background-image: url('https://i.pinimg.com/736x/4a/70/f4/4a70f405a23e39c21903499e2f00a47e.jpg');"></div>
    <div class="grid max-w-screen-xl px-4 py-16 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 relative z-10">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h3 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">Kost Connect</h3>
            <p class="max-w-2xl mb-6 font-light text-gray-200 lg:mb-8 md:text-lg lg:text-xl">Temukan kos yang nyaman, terjangkau, dan strategis sesuai dengan kebutuhan anda di Kost Connect.</p>
            <a href="/daftarkost" class="inline-flex items-center justify-center px-6 py-3 mr-3 text-lg font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 transform transition duration-300 hover:scale-110 shadow-lg">Get started</a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://i.pinimg.com/736x/4a/70/f4/4a70f405a23e39c21903499e2f00a47e.jpg" alt="mockup" class="rounded-lg shadow-xl transform transition duration-500 hover:scale-110 hover:rotate-3">
        </div>
    </div>
</section>

<!-- Statistik Section with Count-up Animation -->
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16">
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
  </section>

<!-- Kos-kosan Features Section -->
<section class="bg-white dark:bg-gray-900 py-16">
    <div class="max-w-screen-xl px-4 mx-auto text-center">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition transform duration-500">
                <img src="https://i.pinimg.com/736x/8e/6e/96/8e6e96db6d77cdc8d0b6d59bb78029f1.jpg" alt="Fasilitas Lengkap" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="mb-2 text-xl font-bold">Fasilitas Lengkap</h3>
                <p>Temukan kos dengan fasilitas seperti Wi-Fi, AC, parkir, dan keamanan 24 jam.</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition transform duration-500">
                <img src="https://i.pinimg.com/736x/3c/07/9e/3c079efaaa9564266ccf8c9a39925d72.jpg" alt="Lokasi Strategis" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="mb-2 text-xl font-bold">Lokasi Strategis</h3>
                <p>Pilih kos yang dekat dengan kampus, pusat belanja, atau kantor anda.</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition transform duration-500">
                <img src="http://www.savingadvice.com/wp-content/uploads/2017/08/saving-money-each-paycheck-.jpg" alt="Harga Terjangkau" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="mb-2 text-xl font-bold">Harga Terjangkau</h3>
                <p>Pilih kos sesuai anggaran anda tanpa mengorbankan kenyamanan.</p>
            </div>
        </div>
    </div>
  </section>
  
<!-- About Section -->
<!-- About Section -->
<!-- About Section -->
<!-- About Kost Connect Section - Detail Tambahan -->
{{-- <section id="about" class="bg-gray-100 dark:bg-gray-800 py-16 relative">
    <div class="max-w-screen-xl px-6 mx-auto text-center"> --}}
        <!-- Heading Section with Animation -->
        {{-- <div class="mb-12 animate__animated animate__fadeIn">
            <h3 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Tentang Kost Connect</h3>
            <p class="text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto animate__animated animate__fadeIn animate__delay-1s">
                Kost Connect hadir untuk memberikan pengalaman pencarian kos yang lebih mudah, cepat, dan nyaman. 
                Kami menghubungkan pemilik kost dengan penghuni, memberikan solusi praktis menggunakan teknologi canggih.
            </p>
        </div> --}}

        <!-- Section 1: Highlight Fitur dengan Animasi -->
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg hover:scale-105 transition-all duration-300">
                <h3 class="text-2xl font-semibold text-blue-600 mb-4">Misi Kami</h3>
                <p class="text-gray-700">Kami berkomitmen membantu anda menemukan kos yang ideal dengan mudah dan cepat, menjamin kenyamanan dan keamanan.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg hover:scale-105 transition-all duration-300">
                <h3 class="text-2xl font-semibold text-teal-600 mb-4">Teknologi Modern</h3>
                <p class="text-gray-700">Dengan teknologi terkini, kami memastikan setiap proses pencarian kos berjalan dengan lancar dan tanpa hambatan.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg hover:scale-105 transition-all duration-300">
                <h3 class="text-2xl font-semibold text-yellow-600 mb-4">Jangkauan Luas</h3>
                <p class="text-gray-700">Kami terus berkembang, sekarang sudah mencakup lebih dari 50 kota di seluruh Indonesia. Temukan kos terbaik di mana saja!</p>
            </div>
        </div>                --}}

        <!-- Section 2: Keunggulan Kost Connect dengan Desain Icon -->
        {{-- <div class="mt-16">
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Kenapa Memilih Kost Connect?</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-xl hover:scale-105 transition-all duration-300 transform hover:translate-y-4">
                    <div class="mb-4 text-5xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Pencarian Cerdas</h4>
                    <p class="text-lg">Dengan filter cerdas, temukan kos terbaik sesuai anggaran dan kebutuhan Anda dalam waktu singkat.</p>
                </div>
                <div class="p-6 rounded-lg bg-gradient-to-r from-green-500 to-teal-600 text-white shadow-xl hover:scale-105 transition-all duration-300 transform hover:translate-y-4">
                    <div class="mb-4 text-5xl">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Keamanan Terjamin</h4>
                    <p class="text-lg">Semua kost yang terdaftar melalui verifikasi ketat untuk memastikan keamanan dan kenyamanan Anda.</p>
                </div>
                <div class="p-6 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-xl hover:scale-105 transition-all duration-300 transform hover:translate-y-4">
                    <div class="mb-4 text-5xl">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Pembayaran Mudah</h4>
                    <p class="text-lg">Nikmati kemudahan melakukan pembayaran sewa kos secara online dengan berbagai metode pembayaran.</p>
                </div>
            </div>
        </div> --}}

        <!-- CTA Section with Animations -->
        {{-- <div class="mt-16 bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-8 animate__animated animate__fadeIn animate__delay-2s">
            <h3 class="text-3xl font-bold mb-4">Siap Menemukan Kos Ideal Anda?</h3>
            <p class="text-lg mb-6">Bergabunglah dengan ribuan pengguna Kost Connect yang sudah menemukan tempat tinggal ideal mereka dengan mudah.</p>
            <a href="/daftarkost" class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-full text-lg font-semibold hover:bg-yellow-600 transition-all duration-300 transform hover:scale-110">Cari Sekarang</a>
        </div> --}}
    {{-- </div>
</section> --}}

<section id="about" class="bg-gray-100 dark:bg-gray-800 py-16">
    <div class="max-w-screen-xl px-6 mx-auto text-center">
        <!-- Heading Section -->
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Area Kos Terpopuler</h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                Temukan kos yang nyaman, terjangkau, dan strategis sesuai dengan kebutuhan anda di Kost Connect.
            </p>
        </div>

        <!-- Grid Section: Display Popular Locations -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-8">
            <div class="relative rounded-lg overflow-hidden group">
                <img src="https://wallpaperaccess.com/full/2043838.jpg" alt="Kos Yogyakarta" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Yogyakarta</h3>
                </div>
            </div>
            <div class="relative rounded-lg overflow-hidden group">
                <img src="https://www.planetware.com/wpimages/2020/06/indonesia-jakarta-top-things-to-do-visit-relax-merdeka-square.jpg" alt="Kos Jakarta" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Jakarta</h3>
                </div>
            </div>
            <div class="relative rounded-lg overflow-hidden group">
                <img src="http://www.indonesia-tourism.com/west-java/images/bandung.jpg" alt="Kos Bandung" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Bandung</h3>
                </div>
            </div>
            <div class="relative rounded-lg overflow-hidden group">
                <img src="https://www.silverkris.com/wp-content/uploads/2017/11/Suroboyo-Monument.jpg" alt="Kos Surabaya" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Surabaya</h3>
                </div>
            </div>
            <!-- Add More Cities -->
            <div class="relative rounded-lg overflow-hidden group">
                <img src="https://www.oyorooms.com/travel-guide/id/wp-content/uploads/sites/6/2022/10/7-Wisata-Sejarah-di-Semarang-Bikin-Nostalgia.jpg" alt="Kos Semarang" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Semarang</h3>
                </div>
            </div>
            <div class="relative rounded-lg overflow-hidden group">
                <img src="https://www.jurnalasia.com/wp-content/uploads/2014/06/Mesjid-RayaMedan-Sumatera-Utara-1.jpg" alt="Kos Semarang" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Medan</h3>
                </div>
            </div>
            <div class="relative rounded-lg overflow-hidden group">
                <img src="https://hitput.com/wp-content/uploads/2019/04/malang-kota-bunga-bersejarah_pesona.travel-1024x540.jpg" alt="Kos Semarang" class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h3 class="text-2xl font-semibold text-white">Kos Malang</h3>
                </div>
            </div>
            <!-- View All Button -->
            <div class="flex justify-center mt-8">
                <a href="/daftarkost" class="inline-flex items-center px-4 py-1 text-md font-medium text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200 transition-all">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>              
        </div>
    </div>
</section>

<section>

    <div class="container">
        <div class="content">
          <h3>Tentang Kost Connect</h3>
          <p class="description">
            Kost Connect hadir untuk memberikan pengalaman pencarian kos yang lebih mudah, cepat, dan nyaman.
            Kami menghubungkan pemilik kost dengan penghuni dan memberikan solusi praktis.
          </p>
        </div>
      </div>
      
      <style>
        .container {
          display: flex;
          flex-direction: column;
          align-items: center;
          background-color: #f9f9f9; /* Latar belakang terang */
          padding: 50px 20px;
          border-radius: 10px;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          max-width: 900px;
          margin: 0 auto;
          text-align: center;
        }
      
        .content h3 {
          font-size: 2.5rem;
          color: #333;
          font-weight: 600;
          margin-bottom: 20px;
          letter-spacing: 1px;
        }
      
        .description {
          font-size: 1.2rem;
          color: #555;
          line-height: 1.6;
          margin-bottom: 30px;
          max-width: 800px;
          margin-left: auto;
          margin-right: auto;
        }
      
        /* Responsif untuk layar lebih kecil */
        @media (max-width: 768px) {
          .container {
            padding: 30px 15px;
          }
      
          .content h3 {
            font-size: 2rem;
          }
      
          .description {
            font-size: 1rem;
          }
        }
      </style>
      
</section>


@endsection

@section('scripts')
<script>
    // Parallax Effect
    document.addEventListener("scroll", function() {
        let parallax = document.querySelector('.parallax');
        let offset = window.pageYOffset;
        parallax.style.backgroundPosition = 'center ' + offset * 0.5 + 'px';
    });
</script>
@endsection

<style>
.parallax {
    transition: background-position 0.2s ease-out;
}
</style>
