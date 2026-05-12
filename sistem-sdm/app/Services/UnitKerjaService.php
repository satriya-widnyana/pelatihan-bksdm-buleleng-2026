<?php

namespace App\Services;

use App\Models\UnitKerja;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class UnitKerjaService
 * 
 * Mengelola logika bisnis terkait data Unit Kerja.
 */
class UnitKerjaService
{
    /**
     * Mengambil seluruh data unit kerja.
     * Menggunakan caching untuk optimalisasi karena data unit kerja jarang berubah.
     *
     * @return Collection
     */
    public function getAllUnitKerja(): Collection
    {
        // Menyimpan data di memori selama 1 jam (3600 detik) untuk efisiensi query
        return Cache::remember('all_unit_kerja', 3600, function () {
            return UnitKerja::orderBy('nama_unit', 'asc')->get();
        });
    }
}
