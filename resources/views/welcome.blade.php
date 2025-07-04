@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="gambar"></div>
        <div class="hero-text">
            <h1>Selamat Datang di Iskandartex</h1>
            <p>Jelajahi koleksi eksklusif dari PT. Iskandartex<br>
                di mana warisan batik berpadu dengan desain modern yang memikat.</p>
        </div>
    </section>

    <!-- Produk Section -->
    <section class="produk" id="produk">
        <div class="container py-5">
            <h2 class="text-center mb-4">Produk Unggulan</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="images/bahan/1.jpeg" class="card-img-top produk-img" alt="Produk 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Produk</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="images/man/hem-pndk-1/1.jpeg" class="card-img-top produk-img" alt="Man">
                        <div class="card-body text-center">
                            <h5 class="card-title">Man</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="images/women/blouse/2.jpg" class="card-img-top produk-img" alt="Women">
                        <div class="card-body text-center">
                            <h5 class="card-title">Women</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="images/couple/couple3/4-2.png" class="card-img-top produk-img" alt="Couple">
                        <div class="card-body text-center">
                            <h5 class="card-title">Couple</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Lihat Semua Produk -->
            <div class="text-center mt-4">
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <!-- Tentang Perusahaan Section -->
<section class="tentang-perusahaan py-5 px-3">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                <img src="{{ asset('images/logo-iskandartex.png') }}" alt="Logo Iskandartex" class="img-fluid" style="max-width: 250px;">
                <h4 class="mt-3 text-danger fw-bold">PT. ISKANDAR INDAH<br>PRINTING TEXTILE</h4>
            </div>

            <!-- Deskripsi -->
            <div class="col-lg-8 text-white">
                <p>
                    Kecintaan keluarga terhadap tekstil berawal sejak bekerja di toko kain milik keluarga besar di Surabaya. 
                    Berbekal pengetahuan dan keterampilan yang dimiliki sebelumnya, kami mencoba mencari peluang yang lebih besar. 
                    Terkenal sebagai Kota Batik, kami pilih Kota Solo sebagai lokasi pertama kami mencoba peruntungan di bidang tekstil.
                </p>
                <p>
                    Sekitar tahun 1969, kami bertemu dengan seorang pengusaha kain batik Solo Laweyan. Melihat kegigihan kami dalam berdagang, 
                    beliau menawarkan tempatnya untuk kami gunakan pada sore hari sebagai tempat produksi batik. 
                    Dengan keterbatasan listrik dan tenaga kerja, para Founder PT. Iskandar Indah Printing Textile yang juga dikenal 
                    dengan nama PT. Iskandartex tetap gigih bekerja hingga larut malam untuk memproduksi kain batik pertamanya 
                    untuk dipasarkan secara mandiri.
                </p>
            </div>
        </div>
    </div>
</section>


    <!-- Maps Section -->
    <section class="maps">
        <div class="maps-text">
            <h2>Outlet Iskandartex</h2>
            <p>Jl. Pakel No.11, Kerten...</p>
        </div>
        <div class="maps-gmaps">
            <iframe src="https://www.google.com/maps/embed?..."></iframe>
        </div>
    </section>

    <!-- Kontak -->
    <section class="kontak" id="kontak">
        <h2>Kontak Kami</h2>
        <p>Hubungi kami lewat WhatsApp: <a href="https://wa.me/6281234567890">0812-3456-7890</a></p>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 TokoKeren. Semua hak dilindungi.</p>
    </footer>
@endsection