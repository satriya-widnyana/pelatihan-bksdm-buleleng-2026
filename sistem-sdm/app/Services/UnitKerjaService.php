<?php

namespace App\Services;

use App\Models\UnitKerja;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class UnitKerjaService
 * 
 * Mengelola logika bisnis terkait data Unit Kerja. Service ini difokuskan
 * pada efisiensi pembacaan data referensi yang bersifat statis (jarang berubah)
 * untuk meminimalkan beban antrean query pada database utama.
 * 
 * @package App\Services
 * @author Tim Backend Buleleng
 * @version 1.0.0
 * @since 2026-05-12
 */
class UnitKerjaService
{
    /**
     * Mengambil seluruh data unit kerja yang diurutkan secara alfabetis.
     * 
     * Metode ini dioptimalkan menggunakan layer caching untuk mengembalikan
     * memori secara instan (Time Complexity: O(1) saat cache hit).
     *
     * @return Collection<int, UnitKerja> Koleksi model Eloquent UnitKerja
     * 
     * @example
     * $service = new UnitKerjaService();
     * $semuaUnit = $service->getAllUnitKerja();
     * echo $semuaUnit->first()->nama_unit; // Menampilkan "Fakultas Teknik"
     */
    public function getAllUnitKerja(): Collection
    {
        // MENGAPA: Data departemen/unit kerja adalah tipe data Master yang 
        // secara historis sangat jarang berubah dalam waktu singkat.
        // Oleh karena itu, memanggil "SELECT * FROM unit_kerjas" setiap saat sangat boros CPU.
        // Di sini kita me-lock hasilnya ke RAM selama 3600 detik (1 jam).
        return Cache::remember('all_unit_kerja', 3600, function () {
            
            // TODO: Di masa mendatang, jika fitur CRUD Unit Kerja ditambahkan oleh tim lain,
            // pastikan untuk menambahkan perintah `Cache::forget('all_unit_kerja')` pada proses Simpan/Update
            // untuk melakukan Invalidasi Cache (Cache Busting).
            return UnitKerja::orderBy('nama_unit', 'asc')->get();
        });
    }
}
