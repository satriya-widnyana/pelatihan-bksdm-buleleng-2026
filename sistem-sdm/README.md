# Sistem Informasi SDM Buleleng

> Platform terpusat untuk manajemen data pegawai (Dosen & Staf) yang dirancang secara khusus untuk memenuhi standar kompetensi BNSP tingkat *Enterprise*.

Sistem ini dikembangkan menggunakan **Laravel 12** dan mengimplementasikan arsitektur *Service-Oriented Architecture (SOA)* untuk memisahkan logika bisnis dari lapisan antarmuka. 

Proyek ini mendemonstrasikan dua unit kompetensi utama BNSP:
1. **J.620100.022.02** - Mengimplementasikan Algoritma Pemrograman
2. **J.620100.023.02** - Membuat Dokumen Kode Program

---

## 🌟 Fitur Utama
- **Web Dashboard Pegawai**: Antarmuka bergaya *Glassmorphism* modern dengan tabel data, pencarian dinamis (berdasarkan NIP & Nama), *custom badges*, dan paginasi interaktif.
- **RESTful API**: Rute API yang aman, berarsitektur *lean controller*, dan merespons dalam format JSON terstruktur.
- **Service Layer & Caching**: Eksekusi *query* berat dialihkan ke *Service Class* dan dikunci menggunakan *Cache* (Redis/File) untuk menghemat beban CPU/RAM server.
- **Dokumentasi Interaktif (Swagger/OpenAPI 3.0)**: Seluruh *endpoint* terdokumentasi secara otomatis dari *source code* ke dalam antarmuka UI dan dapat diuji langsung dari *browser*.
- **Demonstrasi Algoritma**: *Endpoint* khusus (`/api/demo/...`) untuk simulasi komputasi kompleks (Perbandingan O(N²), Binary Search, Fibonacci dengan *Dynamic Programming*, dsb).

---

## 🛠️ Persyaratan Sistem (System Requirements)
Pastikan lingkungan *server* atau PC Anda memenuhi spesifikasi berikut:
- **PHP** >= 8.2
- **Composer** v2
- **MySQL** >= 8.0 / MariaDB
- **Laravel** 12.x

---

## 📦 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek ini di mesin baru:

### 1. Unduh Repositori & Instal Dependensi
Buka terminal, arahkan ke folder root proyek, lalu instal paket pihak ketiga (termasuk *library* dokumentasi Swagger):
```bash
composer install
```

### 2. Konfigurasi Lingkungan (.env)
Salin berkas *environment template*:
```bash
cp .env.example .env
```
Buka file `.env`, lalu pastikan koneksi *database* diatur ke MySQL:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_sdm
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Inisialisasi Keamanan & Database
Buat *database* kosong bernama `sistem_sdm` di MySQL Anda (misal via *Laragon* atau *phpMyAdmin*). Kemudian, bangun struktur tabel dan suntikkan data *dummy* otomatis:
```bash
php artisan key:generate
php artisan migrate --seed
```

### 4. Kompilasi Dokumentasi API
Pindai anotasi (Attributes/DocBlock) di dalam file *Controller* untuk membangun spesifikasi *OpenAPI* interaktif:
```bash
php artisan l5-swagger:generate
```

### 5. Menjalankan Aplikasi
Nyalakan peladen (server) pengembangan internal Laravel:
```bash
php artisan serve
```

---

## 🧭 Panduan Navigasi
Setelah server berjalan, Anda dapat mengakses:
- 🌍 **Aplikasi Web**: Buka `http://127.0.0.1:8000` di *browser*.
- 📘 **Dokumentasi API**: Tekan tombol *Swagger* di halaman utama atau langsung buka `http://127.0.0.1:8000/api/documentation`.
- 🔍 **Pengujian Kualitas Kode (Statis)**: Anda dapat memvalidasi kebenaran sintaks tipe data PHPDoc dengan menjalankan `./vendor/bin/phpstan analyse --level=5 app/`.