<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS App - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.4/lottie.min.js"></script>
    <script src="https://unpkg.com/lottie-player@latest/dist/lottie-player.js"></script>

    <style>
    html {
        scroll-behavior: smooth;
    }
</style>

</head>
<body class="bg-white text-gray-800">
    <!-- Header -->
    <header class="flex justify-between items-center px-10 py-5 bg-blue-600 text-white">
        <h1 class="text-2xl font-bold">PayPoint</h1>
        <nav>
            <a href="#home-section" class="mx-3">Home</a>
            <a href="#about-section" class="mx-3">About</a>
            <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded-md">Login</a>
        </nav>

    </header>

    <section id="home-section" class="flex items-center justify-center px-10 py-16">
    <!-- Text -->
    <div class="w-1/3">
        <h2 class="text-4xl font-bold text-blue-700">Selamat Datang!</h2>
        <p class="text-gray-600 mt-3">Kasir dan Admin PayPoint</p>
        <a href="{{ route('register') }}" class="mt-5 inline-block bg-blue-600 text-white px-6 py-2 rounded-md">
            Register
        </a>
    </div>

    <!-- Image -->
    <div class="w-1/3 flex justify-center">
    <img src="../assets/images/landing.jpg" alt="POS Illustration" class="w-full max-w-md">
    </div>
</section>


        <!-- Lottie Animation -->
       <lottie-player
  src="https://assets4.lottiefiles.com/packages/lf20_2ks8gsxv.json"
  background="transparent"
  speed="1"
  style="width: 300px; height: 300px"
  loop
  autoplay>
</lottie-player>



    <section id="about-section" class="flex flex-col items-center text-center px-10 py-16 bg-gray-100">
    <h2 class="text-3xl font-bold text-blue-700 mb-6">Tentang Aplikasi</h2>
    <p class="text-gray-700 max-w-2xl">
        Aplikasi Point of Sale (POS) ini dirancang untuk membantu pengelolaan transaksi penjualan secara efisien.
        Sistem ini mencatat data pelanggan, produk, kategori, serta transaksi penjualan yang dilakukan. Selain itu,
        aplikasi ini memungkinkan pengguna untuk mengelola stok produk, mencatat pemasok, dan menghasilkan laporan penjualan.
    </p>

    <!-- Bubble Penjelasan Fitur -->
    <!-- Bubble Penjelasan Fitur -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
    <!-- Fitur 1 -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 shadow-lg rounded-lg text-center w-96">
            <h3 class="text-xl font-semibold text-blue-600">Manajemen Produk</h3>
            <p class="text-gray-600 mt-2">Kelola daftar produk dengan mudah, termasuk harga dan stok yang tersedia.</p>
        </div>
    </div>

    <!-- Fitur 2 -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 shadow-lg rounded-lg text-center w-96">
            <h3 class="text-xl font-semibold text-blue-600">Pencatatan Penjualan</h3>
            <p class="text-gray-600 mt-2">Mencatat transaksi dengan cepat dan menghasilkan laporan penjualan secara otomatis.</p>
        </div>
    </div>

    <!-- Fitur 3 -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 shadow-lg rounded-lg text-center w-96">
            <h3 class="text-xl font-semibold text-blue-600">Manajemen Pelanggan</h3>
            <p class="text-gray-600 mt-2">Simpan data pelanggan untuk analisis lebih lanjut dan peningkatan layanan.</p>
        </div>
    </div>

    <!-- Fitur 4 -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 shadow-lg rounded-lg text-center w-96">
            <h3 class="text-xl font-semibold text-blue-600">Transaksi Penjualan</h3>
            <p class="text-gray-600 mt-2">Mencatat setiap transaksi penjualan yang dilakukan, menghubungkan data pelanggan, produk, dan detail transaksi.</p>
        </div>
    </div>

    <!-- Fitur 5 -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 shadow-lg rounded-lg text-center w-96">
            <h3 class="text-xl font-semibold text-blue-600">Detail Penjualan</h3>
            <p class="text-gray-600 mt-2">Menyimpan informasi detail setiap transaksi, seperti produk yang dibeli dan jumlahnya.</p>
        </div>
    </div>

    <!-- Fitur 6 (Fix: Dipindah ke dalam grid) -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 shadow-lg rounded-lg text-center w-96">
            <h3 class="text-xl font-semibold text-blue-600">Struk Belanja Otomatis</h3>
            <p class="text-gray-600 mt-2">Setiap transaksi secara otomatis menghasilkan struk belanja digital yang bisa dicetak.</p>
        </div>
    </div>
</div>

    </div>
</section>

    <!-- Bubble Notes -->
    <section class="py-10 flex justify-center flex-wrap gap-6">
        <div class="bg-blue-100 text-blue-600 p-4 rounded-lg shadow-md w-64">
            <p>Mengelola transaksi lebih mudah dan cepat</p>
        </div>
        <div class="bg-blue-100 text-blue-600 p-4 rounded-lg shadow-md w-64">
            <p>Akses data penjualan kapan saja</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-gray-200 text-gray-700">
        <p>© 2025 POS App. All rights reserved.</p>
    </footer>

    <!-- Script Lottie -->
    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets3.lottiefiles.com/packages/lf20_kqnr6v35.json' // Ganti dengan link animasi yang kamu inginkan
        });
    </script>
</body>
</html>
