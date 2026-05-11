<?php

namespace App\Services;

use App\Models\Pegawai;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * Class PegawaiService
 * 
 * Menangani business logic kompleks untuk entitas Pegawai.
 */
class PegawaiService
{
    /**
     * Mengambil data pegawai dengan dukungan pencarian, pengurutan dinamis, paginasi, dan caching.
     *
     * @param string|null $search Kriteria pencarian.
     * @param array $sorts Kriteria pengurutan [['field' => 'nama', 'dir' => 'asc']].
     * @param int $perPage Limit data per halaman.
     * @param int $page Halaman saat ini.
     * @return LengthAwarePaginator
     */
    public function getPaginatedPegawai(?string $search, array $sorts = [], int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        // MENGAPA: Kita menghasilkan signature (hash unik) berdasarkan kombinasi parameter input.
        // Dengan hash ini, request identik dapat dilayani langsung dari memory cache (Redis/Memcached).
        $cacheKey = 'pegawai_paginate_' . md5(json_encode([$search, $sorts, $perPage, $page]));

        // MENGAPA: Cache::tags digunakan agar kita nantinya dapat menghapus hanya grup cache 'pegawai'
        // secara spesifik ketika ada data yang diubah, tanpa merusak cache fitur sistem lainnya.
        // Catatan: Cache::tags memerlukan driver Redis atau Memcached.
        // Jika pakai database/file driver, tags tidak didukung, kita pakai remember biasa untuk fallback aman.
        if (Cache::supportsTags()) {
            return Cache::tags(['pegawai'])->remember($cacheKey, now()->addMinutes(60), function () use ($search, $sorts, $perPage) {
                return $this->buildQuery($search, $sorts)->paginate($perPage);
            });
        }

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($search, $sorts, $perPage) {
            return $this->buildQuery($search, $sorts)->paginate($perPage);
        });
    }

    /**
     * Membangun base query untuk pegawai.
     * 
     * @param string|null $search
     * @param array $sorts
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function buildQuery(?string $search, array $sorts)
    {
        // Eager Loading relasi untuk menghindari problem N+1 query.
        $query = Pegawai::query()->with('unitKerja');

        // --- ALGORITMA PENCARIAN ---
        if (!empty($search)) {
            // MENGAPA: Kondisi ini dibungkus closure `where(function($q))` agar
            // operator `OR` pada pencarian tidak tumpang tindih dengan klausa `WHERE` lain nantinya.
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('status_kepegawaian', 'like', "%{$search}%");
            });
        }

        // --- ALGORITMA PENGURUTAN DINAMIS ---
        if (empty($sorts)) {
            // MENGAPA: Jika tidak ada instruksi sort dari user, gunakan fallback sort 
            // agar urutan data konsisten dan tidak acak oleh database engine.
            $query->orderBy('id', 'desc');
        } else {
            foreach ($sorts as $sort) {
                $query->orderBy($sort['field'], $sort['dir']);
            }
        }

        return $query;
    }
}
