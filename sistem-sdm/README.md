# Sistem Informasi SDM - Undiksha

> Platform terpusat untuk manajemen data pegawai (Dosen & Staf) yang mengintegrasikan berbagai sub-sistem menjadi Single Source of Truth.

## Deskripsi Proyek
Sistem ini dirancang untuk mengatasi redundansi data pegawai dengan menerapkan arsitektur *Service Layer* dan optimasi algoritma pencarian. Sistem ini mendukung standar integrasi data melalui API yang terdokumentasi dengan OpenAPI 3.0.

## Fitur Utama
- **Manajemen Data Pegawai**: Pencarian dan filter multi-field yang efisien.
- **High Performance Searching**: Implementasi *caching* pada Service Layer untuk optimasi query.
- **API Documentation**: Dokumentasi interaktif menggunakan Swagger UI.
- **Scalable Architecture**: Pemisahan logika bisnis menggunakan Service Pattern untuk mempermudah pemeliharaan.

## Persyaratan Sistem
- PHP 8.2+
- Laravel 12.x
- MySQL 8.0+

## Cara Menjalankan Proyek
1. Buka terminal di folder proyek.
2. Salin konfigurasi environment: `cp .env.example .env`
3. Generate key aplikasi: `php artisan key:generate`
4. Sesuaikan konfigurasi database di file `.env`.
5. Jalankan migrasi: `php artisan migrate`
6. Generate dokumentasi API: `php artisan l5-swagger:generate`
7. Jalankan server: `php artisan serve`