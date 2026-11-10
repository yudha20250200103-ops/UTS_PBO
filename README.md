# Sistem Login dan Dashboard Admin

Aplikasi autentikasi admin dan dashboard manajemen sederhana dengan PHP native, MySQL, Bootstrap 5, dan Font Awesome. Antarmuka menggunakan bahasa Indonesia dan dirancang agar mudah dipelajari serta responsif pada desktop maupun ponsel.

## Fitur

- Login menggunakan email atau nama admin, validasi formulir, dan tombol tampil/sembunyikan password.
- Password tersimpan sebagai hash `password_hash()` dan diverifikasi dengan `password_verify()`.
- Query menggunakan PDO prepared statements; sesi dilindungi dengan regenerasi ID setelah login.
- Proteksi dashboard, data pengguna, dan profil; halaman terlindungi menggunakan header anti-cache.
- Logout melalui POST dengan token CSRF, menghapus sesi dan cookie sesi.
- Dashboard berisi ringkasan pengguna, daftar pengguna, dan profil admin.

## Teknologi

- HTML5, CSS3, JavaScript
- PHP native (disarankan PHP 8.0 atau lebih baru) dan ekstensi PDO MySQL
- MySQL/MariaDB
- Bootstrap 5.3.3, Font Awesome 6.5.2, dan Google Fonts melalui CDN

## Persyaratan

- XAMPP dengan Apache, PHP, dan MySQL/MariaDB aktif.
- Koneksi internet untuk memuat Bootstrap, Font Awesome, dan Google Fonts dari CDN.

## Instalasi di XAMPP

1. Salin folder `sistem-login` ke dalam direktori `htdocs`, misalnya `C:\xampp\htdocs\sistem-login`.
2. Buka XAMPP Control Panel, lalu jalankan **Apache** dan **MySQL**.
3. Buka `http://localhost/phpmyadmin`.
4. Pilih tab **Import**, pilih file `database.sql`, lalu jalankan proses import. File ini membuat database `db_sistem_login`, tabel `users`, dan akun admin uji.
5. Pastikan pengaturan database pada `config/database.php` sesuai dengan MySQL lokal. Nilai bawaan adalah host `127.0.0.1`, database `db_sistem_login`, user `root`, dan password kosong (konfigurasi default XAMPP). Untuk kredensial lain, atur environment variable `DB_HOST`, `DB_NAME`, `DB_USER`, dan `DB_PASS` pada konfigurasi server PHP; jangan menaruh password database pribadi ke Git.
6. Kunjungi `http://localhost/sistem-login/`.

## Database dan akun uji

- Database: `db_sistem_login`
- Tabel: `users` (`id`, `name`, `email`, `password`, `created_at`)
- Email: `admin@gmail.com`
- Password: `admin123`

Nilai pada kolom `password` dalam SQL adalah hash bcrypt yang dihasilkan dengan PHP `password_hash()`, bukan password plaintext.

## Menjalankan dan menguji

1. Jalankan Apache dan MySQL di XAMPP.
2. Buka URL project pada browser dan masuk dengan kredensial uji di atas.
3. Coba password yang salah; halaman login harus menampilkan pesan kredensial salah.
4. Buka `dashboard.php`, `users.php`, atau `profile.php` dalam sesi privat/logged-out; setiap halaman akan mengarahkan kembali ke login.
5. Klik **Keluar**, lalu tekan tombol Back browser. Konten terlindungi tidak boleh ditampilkan dari cache; muat ulang juga harus tetap mengarahkan ke login.
6. Periksa daftar pengguna dan profil melalui sidebar.

Jika muncul pesan koneksi database, pastikan MySQL aktif dan nilai konfigurasi database sesuai. Detail kesalahan koneksi dicatat di error log PHP/Apache dan tidak ditampilkan kepada pengunjung.

## Screenshot untuk laporan

Ambil screenshot untuk bukti pengerjaan berikut:

1. Halaman login pada desktop (dan tampilan mobile responsif bila diperlukan).
2. Dashboard setelah login, termasuk kartu statistik dan sidebar.
3. Halaman Data Pengguna.
4. Halaman Profil Admin.
5. Pesan kesalahan setelah login dengan password yang salah.
6. Halaman phpMyAdmin yang memperlihatkan tabel `users` dan nilai password dalam bentuk hash.

## Struktur project

```text
sistem-login/
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── config/database.php
├── includes/
│   ├── auth.php
│   ├── footer.php
│   ├── header.php
│   └── sidebar.php
├── dashboard.php
├── database.sql
├── index.php
├── logout.php
├── profile.php
└── users.php
```

## GitHub

Project ini tidak menyimpan password database pribadi. File `.gitignore` mengecualikan berkas environment lokal. Setelah Git tersedia, repository lokal dapat dibuat dengan `git init`, lalu perubahan pertama disimpan dengan pesan `Initial commit - Sistem Login Dashboard`. Remote GitHub tidak dikonfigurasi karena URL repository belum diberikan.
