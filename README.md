# TokoKita 2750 - Marketplace E-commerce

Sistem marketplace berbasis web untuk mengelola jual beli produk online dengan fitur lengkap untuk admin, penjual, dan pembeli.

## Teknologi yang Digunakan

- **Framework**: CodeIgniter 3
- **Bahasa**: PHP
- **Database**: MySQL (mysqli)
- **Pembayaran**: Midtrans Snap Payment Gateway
- **Ongkos Kirim**: RajaOngkir API
- **Server**: XAMPP (Apache + MySQL)

## Fitur Utama

### Admin
- Dashboard admin
- Manajemen produk (CRUD)
- Manajemen kategori produk
- Manajemen merek
- Manajemen pembeli
- Manajemen promo
- Manajemen diskon
- Manajemen pertanyaan produk
- Manajemen profil admin
- Ganti password admin

### Penjual
- Registrasi dan login penjual
- Manajemen toko (CRUD)
- Manajemen produk toko (CRUD)
- Jawab pertanyaan produk

### Pembeli
- Registrasi dan login pembeli
- Lihat katalog produk
- Detail produk
- Keranjang belanja
- Checkout dengan Midtrans
- Cek ongkos kirim via RajaOngkir
- Riwayat pesanan
- Tanya jawab produk
- Penggunaan diskon

### Umum
- Autentikasi pengguna (admin, penjual, pembeli)
- Pengelolaan session
- Upload foto produk dan toko

## Struktur Proyek

```
tokokita_2750/
├── application/
│   ├── controllers/
│   │   ├── admin/           # Controller admin
│   │   ├── Auth.php        # Autentikasi pembeli
│   │   ├── Cart.php        # Keranjang
│   │   ├── Checkout.php    # Checkout
│   │   ├── Home.php        # Halaman utama
│   │   ├── Toko.php        # Manajemen toko
│   │   └── ...
│   ├── models/
│   │   ├── admin/
│   │   ├── Produk_model.php
│   │   ├── Cart_model.php
│   │   └── ...
│   ├── views/
│   │   ├── admin/
│   │   ├── homepage/
│   │   ├── checkout/
│   │   └── ...
│   ├── libraries/
│   │   ├── Midtrans/       # Library Midtrans
│   │   └── RajaOngkir.php  # Library RajaOngkir
│   └── config/
├── system/                  # CodeIgniter core
├── index.php
└── README.md
```

## Instalasi

1. **Clone atau pindahkan proyek ke direktori web server (htdocs pada XAMPP)
2. **Buat database MySQL dengan nama `marketplace_2750`
3. **Import database (jika ada file SQL)
4. **Konfigurasi database di `application/config/database.php`
5. **Konfigurasi base URL di `application/config/config.php`
   ```php
   $config['base_url'] = 'http://localhost/tokokita_2750/';
   ```
6. **Konfigurasi API Key RajaOngkir di `application/config/config.php`
   ```php
   $config['rajaongkir_api_key'] = 'your_api_key';
   $config['rajaongkir_base_url'] = 'https://rajaongkir.komerce.id/api/v1/';
   ```
7. **Konfigurasi Midtrans di `application/controllers/Checkout.php`
   ```php
   \Midtrans\Config::$serverKey = 'your_midtrans_server_key';
   ```
8. **Buat folder uploads:
   - `uploads/`
   - `uploads/toko/`
9. **Akses proyek via browser: `http://localhost/tokokita_2750/`

## Konfigurasi Database

File: `application/config/database.php`

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'marketplace_2750',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

## Hak Akses

- **Admin**: Akses semua fitur manajemen
- **Penjual**: Akses manajemen toko dan produk
- **Pembeli**: Akses belanja dan fitur pembeli

## Catatan Penting

- Pastikan `upload_max_filesize dan `post_max_size` di php.ini cukup besar untuk upload file foto
- Pastikan folder uploads memiliki permission writable
- Untuk development, gunakan Midtrans Sandbox
- Untuk production, ganti `$isProduction` menjadi `true`

## Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan pengembangan sistem e-commerce.

