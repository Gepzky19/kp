<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pembeli</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header>
        <h1>Dashboard Pembeli</h1>
    </header>

    <main>
        <section class="kategori">
            <h2>Kategori Produk</h2>
            <div class="tabs">
                <button onclick="showKategori('man')">Man</button>
                <button onclick="showKategori('women')">Women</button>
                <button onclick="showKategori('couple')">Couple</button>
                <button onclick="showKategori('sarung')">Sarung</button>
                <button onclick="showKategori('bahan')">Bahan</button>
            </div>
        </section>

        <section class="produk-list" id="produk-container">
            <!-- Produk ditampilkan lewat JS -->
        </section>

        <section class="keranjang">
            <h2>Keranjang</h2>
            <ul id="keranjang-list"></ul>
            <p><strong>Total:</strong> <span id="total-harga">Rp 0</span></p>
            <button onclick="checkout()">Checkout</button>
        </section>
    </main>

    <script>
        const produk = [
            {id: 1, name: "Batik Kawung", price: 129000, stock: 1, category: "couple"},
            {id: 2, name: "Batik Solo", price: 150000, stock: 3, category: "man"},
            {id: 3, name: "Batik Sumatra", price: 145000, stock: 1, category: "man"},
            {id: 4, name: "Batik Sumatra", price: 145000, stock: 10, category: "man"},
            {id: 5, name: "Batik Sulawesi", price: 120000, stock: 20, category: "man"},
        ];

        let keranjang = [];

        function showKategori(kat) {
            const container = document.getElementById('produk-container');
            container.innerHTML = '';
            produk.filter(p => p.category === kat).forEach(p => {
                container.innerHTML += `
                    <div class="produk-card">
                        <h3>${p.name}</h3>
                        <p>Harga: Rp ${p.price.toLocaleString()}</p>
                        <p>Stok: ${p.stock}</p>
                        <button onclick="addToCart(${p.id})">+ Keranjang</button>
                    </div>
                `;
            });
        }

        function addToCart(id) {
            const p = produk.find(p => p.id === id);
            keranjang.push(p);
            updateCart();
        }

        function updateCart() {
            const list = document.getElementById('keranjang-list');
            const total = document.getElementById('total-harga');
            list.innerHTML = '';
            let totalHarga = 0;
            keranjang.forEach((item, index) => {
                totalHarga += item.price;
                list.innerHTML += `<li>${item.name} - Rp ${item.price.toLocaleString()}</li>`;
            });
            total.textContent = 'Rp ' + totalHarga.toLocaleString();
        }

        function checkout() {
            alert("Checkout berhasil! (" + keranjang.length + " item)");
            keranjang = [];
            updateCart();
        }

        // Default tampilkan kategori 'man'
        showKategori('man');
    </script>
</body>
</html>
