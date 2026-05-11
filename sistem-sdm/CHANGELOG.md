# Changelog

Semua perubahan penting pada proyek Sistem SDM ini akan didokumentasikan di sini.
Format mengikuti [Keep a Changelog](https://keepachangelog.com/id/) dan proyek ini mengikuti [Semantic Versioning](https://semver.org/).

## [Unreleased]
### Added
- Integrasi algoritma pencarian multi-field pada `PegawaiService`.
- Penambahan otentikasi API menggunakan Laravel Sanctum.

## [1.1.0] - 2026-05-11
### Added
- Implementasi `PegawaiService` untuk memisahkan logika algoritma dari Controller sesuai standar J.620100.022.02.
- Mekanisme **Caching** pada pencarian pegawai menggunakan `Cache::remember` untuk optimasi performa.
- Dokumentasi API otomatis menggunakan `darkaonline/l5-swagger` (OpenAPI 3.0).
- Penulisan **PHPDoc** lengkap pada Model, Service, dan Controller.

### Changed
- Refactor `PegawaiController` agar lebih ringkas (Lean Controller).
- Pembaruan skema database untuk mendukung relasi antara `Pegawai` dan `UnitKerja`.

## [1.0.0] - 2026-05-10
### Added
- Inisialisasi proyek menggunakan Laravel 12.x.
- Pembuatan struktur folder dokumentasi proyek (`docs/adr`).
- Konfigurasi awal database dan environment.