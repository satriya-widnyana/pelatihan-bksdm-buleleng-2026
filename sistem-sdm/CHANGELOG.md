# Changelog

Semua perubahan signifikan yang terjadi pada Sistem SDM ini akan didokumentasikan di dalam file ini.

## [1.0.0] - 2026-05-12

### Ditambahkan (Added)
- **Service Layer Architecture**: Kelas `PegawaiService` dan `UnitKerjaService` untuk memisahkan *business logic* berat dari *Controller*, memastikan kode lebih modular (*SOLID Principle*).
- **Database & Migration**: Skema tabel untuk `pegawais` dan `unit_kerjas` beserta kelas *Seeder* untuk data simulasi massal.
- **RESTful API Endpoints**: 
  - `GET /api/pegawai` (Dilengkapi filter pencarian, *sorting*, dan *pagination* kustom via `IndexPegawaiRequest`).
  - `GET /api/unit-kerja` (Mengembalikan daftar divisi departemen yang dilindungi mekanisme *Cache* 1 jam).
- **Dokumentasi API Terpusat (L5-Swagger)**: 
  - Penggunaan *Single-Line PHP 8 Attributes* pada seluruh *Controller* untuk mengatasi parser *error* pada editor versi lawas.
  - Halaman antarmuka interaktif yang dapat diakses melalui `/api/documentation`.
- **Materi Demonstrasi Algoritma BNSP**: Rute `/api/demo/...` untuk perbandingan kecepatan nyata (`microtime`) eksekusi algoritma:
  - *Sorting*: Bubble Sort vs `usort()` bawaan C.
  - *Searching*: Linear vs Binary vs Hash Table *Dictionary*.
  - *Dynamic Programming*: Rekursif Naif vs Teknik Memoisasi (*Memoization*).
  - *Data Structures*: PHP `SplQueue` dan `Generator` memori O(1).
- **Antarmuka Pengguna (Web UI)**:
  - Beranda (*Landing Page*) bergaya modis *Glassmorphism*.
  - Halaman `GET /pegawai` modern yang menyatukan data *database* dan hasil komputasi *Service Layer*.
- **CI/CD Pipeline Validasi**: Menambahkan `.github/workflows/validate-docs.yml` untuk menjaga akurasi deklarasi tipe *PHPDoc* (*PHPStan*) pada proses peluncuran ke peladen produksi.

### Diubah (Changed)
- Konfigurasi *engine* basis data utama di file `.env` diubah dari struktur statis **SQLite** (bawaan *default* Laravel 12) menjadi sistem RDBMS relasional **MySQL**.