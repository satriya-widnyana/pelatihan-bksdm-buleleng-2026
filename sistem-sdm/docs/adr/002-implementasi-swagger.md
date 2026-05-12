# ADR 002: Penggunaan L5-Swagger untuk Dokumentasi API

## 1. Konteks (Context)
Sistem SDM Buleleng memiliki antarmuka API yang akan dikonsumsi oleh tim *Frontend* (Vue.js) dan tim *Mobile* (Flutter). Selama ini, komunikasi kontrak API dilakukan secara manual melalui dokumen Word atau pesan Slack yang seringkali tertinggal pembaruannya (*outdated*). Hal ini menyebabkan *overhead* komunikasi yang tinggi dan *bug* pada tahap integrasi.

## 2. Keputusan (Decision)
Kami memutuskan untuk menggunakan *package* `darkaonline/l5-swagger` (berbasis spesifikasi OpenAPI 3.0) untuk mendokumentasikan semua *endpoint* API secara langsung di dalam kode sumber (*source code*) menggunakan PHP 8 Attributes.

## 3. Mengapa Keputusan Ini Diambil? (Rationale)
1. **Single Source of Truth:** Dokumentasi hidup berdampingan dengan kode. Jika logika atau struktur parameter diubah di Controller, pengembang diwajibkan mengubah anotasi di file yang sama.
2. **Kepatuhan BNSP:** Memenuhi elemen kompetensi Unit **J.620100.023.02** terkait "Membuat Dokumen Kode Program".
3. **Uji Coba Interaktif:** *Swagger UI* menyediakan tombol "Try It Out", memungkinkan pengembang *Frontend* menguji *endpoint* langsung dari *browser* tanpa perlu mengkonfigurasi Postman.

## 4. Konsekuensi (Consequences)
1. **Kelebihan:** Mengurangi miskomunikasi antar tim, mempercepat proses *onboarding* anggota tim baru.
2. **Kekurangan:** Menambah panjang baris pada *Controller* (*boilerplate*) akibat banyaknya baris anotasi dokumentasi.
3. **Mitigasi:** Diterapkan aturan integrasi berkelanjutan (CI/CD) via GitHub Actions agar setiap pembuatan fitur baru divalidasi ketersediaan dan validitas dokumentasinya sebelum digabung (*merge*) ke cabang utama.
