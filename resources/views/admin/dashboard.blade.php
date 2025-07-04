<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: sans-serif; padding: 30px; background: #f4f4f4; }
        section {
            background: white; padding: 20px;
            border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, textarea, button {
            width: 100%; padding: 10px; margin-top: 10px;
        }
        .link-button {
            display: inline-block; margin-top: 20px;
            padding: 10px 15px; background: #007BFF;
            color: white; text-decoration: none; border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Dashboard Admin - Upload Produk</h2>

    <section>
        <h3>Upload Produk Baru</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            <label>Nama Produk:</label>
            <input type="text" name="nama" placeholder="Contoh: Batik Solo" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="4" placeholder="Deskripsi produk..." required></textarea>

            <label>Harga:</label>
            <input type="number" name="harga" placeholder="Contoh: 150000" required>

            <label>Gambar Produk:</label>
            <input type="file" name="gambar" required>

            <button type="submit">Upload Produk</button>
        </form>

        <a href="{{ url('/admin/report?admin=Admin') }}" class="link-button">Lihat Laporan Transaksi</a>
        <a href="{{ url('/admin/receipt') }}" class="link-button">Cetak Struk</a>  <!-- Tombol Cetak Struk -->
    </section>
</body>
</html>
