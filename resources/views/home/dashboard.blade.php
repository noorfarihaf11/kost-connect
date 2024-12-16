@extends('home.layouts.main')

@section('content')

<!-- Hero Section with Parallax and Background Animation -->
<section class="relative bg-gradient-to-r from-blue-500 via-teal-500 to-green-500 text-white">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 parallax" style="background-image: url('https://i.pinimg.com/736x/4a/70/f4/4a70f405a23e39c21903499e2f00a47e.jpg');"></div>
    <div class="grid max-w-screen-xl px-4 py-16 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 relative z-10">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h3 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl animate__animated animate__fadeIn animate__delay-1s">Kost Connect</h3>
            <p class="max-w-2xl mb-6 font-light text-gray-200 lg:mb-8 md:text-lg lg:text-xl animate__animated animate__fadeIn animate__delay-2s">Temukan kos yang nyaman, terjangkau, dan strategis sesuai dengan kebutuhan anda di Kost Connect.</p>
            <a href="/daftarkost" class="inline-flex items-center justify-center px-6 py-3 mr-3 text-lg font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900 transform transition duration-300 ease-in-out hover:scale-110 shadow-lg hover:shadow-xl" aria-label="Get Started">
                Get started
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://i.pinimg.com/736x/4a/70/f4/4a70f405a23e39c21903499e2f00a47e.jpg" alt="mockup" class="w-63 h-auto rounded-lg shadow-xl transform transition duration-500 hover:scale-110 hover:rotate-3" loading="lazy">
        </div>
    </div>
</section>

<!-- Statistik Section with Count-up Animation -->
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
        <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-3 dark:text-white">
            <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">1,500+</dt>
                <dd class="font-light text-gray-500 dark:text-gray-400">Kos Terdaftar</dd>
            </div>
            <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">10K+</dt>
                <dd class="font-light text-gray-500 dark:text-gray-400">Pengguna Aktif</dd>
            </div>
            <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">50+</dt>
                <dd class="font-light text-gray-500 dark:text-gray-400">Kota Terjangkau</dd>
            </div>
        </dl>
    </div>
  </section>
</section>

<!-- Kos-kosan Features Section with 3D Hover and Animation -->
<section class="bg-white dark:bg-gray-900 py-16">
    <div class="max-w-screen-xl px-4 mx-auto text-center">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3 mt-8">
            <!-- Fasilitas Lengkap -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-500 ease-in-out hover:scale-105 hover:shadow-2xl hover:rotate-1 hover:bg-primary-50 dark:hover:bg-primary-900 relative">
                <img src="https://i.pinimg.com/736x/8e/6e/96/8e6e96db6d77cdc8d0b6d59bb78029f1.jpg" alt="Fasilitas Lengkap" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Fasilitas Lengkap</h3>
                <p class="text-gray-500 dark:text-gray-400">Temukan kos dengan fasilitas lengkap seperti Wi-Fi, AC, tempat parkir, dan keamanan 24 jam untuk kenyamanan anda.</p>
            </div>
  
            <!-- Lokasi Strategis -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-500 ease-in-out hover:scale-105 hover:shadow-2xl hover:rotate-1 hover:bg-primary-50 dark:hover:bg-primary-900 relative">
                <img src="https://i.pinimg.com/736x/3c/07/9e/3c079efaaa9564266ccf8c9a39925d72.jpg" alt="Lokasi Strategis" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Lokasi Strategis</h3>
                <p class="text-gray-500 dark:text-gray-400">Pilih kos yang terletak dekat dengan kampus, pusat perbelanjaan, atau tempat kerja anda.</p>
            </div>
  
            <!-- Harga Terjangkau -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-500 ease-in-out hover:scale-105 hover:shadow-2xl hover:rotate-1 hover:bg-primary-50 dark:hover:bg-primary-900 relative">
                <img src="http://www.savingadvice.com/wp-content/uploads/2017/08/saving-money-each-paycheck-.jpg" alt="Harga Terjangkau" class="w-full h-48 object-cover rounded-lg mb-4">>
                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Harga Terjangkau</h3>
                <p class="text-gray-500 dark:text-gray-400">Pilih kos yang sesuai dengan anggaran anda, tanpa mengorbankan kenyamanan dan fasilitas.</p>
            </div>
        </div>
    </div>
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

    // Count-up Animation for Statistics
    document.querySelectorAll('.count-up').forEach(function(element) {
        let count = 0;
        let target = parseInt(element.getAttribute('data-target'));
        let interval = setInterval(function() {
            if (count < target) {
                count++;
                element.textContent = count;
            } else {
                clearInterval(interval);
            }
        }, 10);  // Speed of count-up
    });
</script>
@endsection

<style>
/* Parallax Effect CSS */
.parallax {
    transition: background-position 0.2s ease-out;
}
</style>
