<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Desa Plaosan - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 text-gray-800">

    <!-- Navbar Sticky -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center gap-3">
          <img src="{{ asset('sides.png') }}" alt="Logo" class="h-12 w-auto object-contain" />
          <div class="text-xl font-bold text-green-600">Desa Plaosan</div>
        </div>
        <div class="hidden md:flex items-center gap-4">
          <a href="{{ route('login') }}" class="bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-700">
            Masuk
          </a>
          <a href="{{ route('register') }}" class="bg-yellow-500 text-white py-2 px-6 rounded-full hover:bg-yellow-600">
            Daftar
          </a>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('gapura.jpg') }}');">
      <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Desa Plaosan</h1>
        <p class="text-lg md:text-xl mb-6">Sistem Manajemen Layanan Masyarakat Desa Plaosan</p>
        </div>
      </div>
    </section>

    <!-- Konten Utama -->
    <main class="max-w-4xl mx-auto mt-14 px-4">
      <h2 class="text-3xl font-bold mb-4 text-center text-gray-800">Tentang Desa Plaosan</h2>
      <p class="text-gray-700 mb-4 text-justify">
        Desa Plaosan merupakan salah satu desa yang berada di Kecamatan Babat, Kabupaten Lamongan, Jawa Timur, Indonesia. Desa ini terletak sekitar 3 km dari ibu kota kecamatan, dengan lama tempuh sekitar 10 menit. Jarak ke ibu kota Kabupaten Lamongan adalah 10 km, dengan waktu tempuh sekitar 30 menit.
      </p>
      <p class="text-gray-700 mb-4 text-justify">
        Secara geografis, Desa Plaosan memiliki luas wilayah 207,894 hektar dan merupakan wilayah agraris, dengan sebagian besar penduduknya bekerja sebagai petani. Namun, terdapat pula penduduk yang bekerja sebagai pedagang dan wiraswasta. Desa ini terletak di samping jalan raya, yang mempermudah akses ke berbagai tempat.
      </p>

      <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-700">Batas Wilayah</h3>
      <ul class="list-disc list-inside text-gray-700 mb-4">
        <li><strong>Sebelah Barat:</strong> Desa Bedahan</li>
        <li><strong>Sebelah Timur:</strong> Persawahan Petro</li>
        <li><strong>Sebelah Selatan:</strong> Desa Sogo</li>
      </ul>

      <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-700">Luas Wilayah Desa Plaosan</h3>
      <ul class="list-disc list-inside text-gray-700 mb-10">
        <li><strong>Persawahan:</strong> 25.110 Ha</li>
        <li><strong>Telaga:</strong> 5.022 Ha</li>
        <li><strong>Jalan:</strong> 32.024 Ha</li>
        <li><strong>Makam:</strong> 12.045 Ha</li>
        <li><strong>Tanah Perkarangan / Bangunan:</strong> 9.042 Ha</li>
        <li><strong>Tanah Lain:</strong> 12.031 Ha</li>
      </ul>

      <div class="my-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-center text-gray-800">Lokasi Kantor Desa</h2>
        <p class="text-center text-gray-700 mb-6">
          Jl. Raya Plaosan No. 19, Kecamatan Babat, Lamongan, Jawa Timur. Kode Pos: <strong>62271</strong>.
        </p>
        <div class="overflow-hidden rounded-lg shadow-lg">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3897.361158278307!2d112.1841168749253!3d-7.100012992903271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e778c56927625b9%3A0xb32013f1f3fff683!2sKANTOR%20DESA%20PLAOSAN!5e1!3m2!1sen!2sid!4v1744564963985!5m2!1sen!2sid"
            width="100%"
            height="450"
            class="block border-0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center mt-10">
      © 2025 Sistem Manajemen Layanan Masyarakat Desa Plaosan - by Restu Agung Pramuditya
    </footer>

  </body>
</html>
