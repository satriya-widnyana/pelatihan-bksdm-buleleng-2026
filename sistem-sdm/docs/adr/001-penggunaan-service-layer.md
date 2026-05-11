# ADR 001: Penggunaan Service Layer untuk Algoritma

## Status
Accepted - 2026-05

## Konteks
Sistem SDM Undiksha memiliki logika bisnis yang kompleks, terutama dalam sinkronisasi data antar unit, pencarian data pegawai, dan pengurutan. Menempatkan logika ini langsung di Controller akan menyebabkan struktur kode yang berantakan dan sulit dikelola (*Fat Controller*).

## Keputusan
Kami memutuskan untuk memindahkan seluruh algoritma pemrograman (pencarian, pengurutan, dan manipulasi data) ke dalam **Service Layer** (terletak di folder `app/Services/`). 

## Alasan
1. **Standar Kompetensi**: Memenuhi kriteria unjuk kerja unit J.620100.022.02 Elemen 6 untuk menempatkan algoritma dalam *Service Layer*.
2. **Kerapian (Clean Code)**: Memisahkan antara logika pengiriman data (HTTP) di Controller dengan logika bisnis di Service.
3. **Reusability**: Logika algoritma yang sama bisa dipanggil berulang kali di berbagai tempat tanpa harus menulis ulang kodenya.

## Konsekuensi
Sistem akan memiliki lapisan abstraksi tambahan. *Developer* baru harus memahami pola arsitektur *Service Layer* sebelum bisa berkontribusi secara efektif.