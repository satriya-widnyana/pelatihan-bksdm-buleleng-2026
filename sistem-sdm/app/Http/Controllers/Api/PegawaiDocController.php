<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class PegawaiDocController extends Controller
{
    #[OA\Get(path: "/api/pegawai-doc/{id}", summary: "Mengambil data detail pegawai (Demo)", tags: ["Pegawai (Dokumentasi)"])]
    #[OA\Parameter(name: "id", in: "path", required: true)]
    #[OA\Response(response: 200, description: "Berhasil")]
    #[OA\Response(response: 404, description: "Tidak Ditemukan")]
    public function show($id = null): JsonResponse
    {
        // Validasi jika ID kosong
        if (empty($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID Pegawai is required! Parameter ID tidak boleh kosong.'
            ], 400);
        }

        // Mengambil data riil dari database beserta relasi Unit Kerja
        $pegawai = \App\Models\Pegawai::with('unitKerja')->find((int)$id);

        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => "Data Pegawai Required! ID {$id} tidak terdaftar di sistem."
            ], 404);
        }

        // Menggunakan PegawaiDocService untuk kalkulasi remunerasi (Mendemonstrasikan Elemen Kompetensi 2)
        $docService = new \App\Services\PegawaiDocService();
        $remunerasi = 0;
        
        try {
            $remunerasi = $docService->hitungRemunerasiPegawai([
                'gaji_pokok' => 4500000, // Hardcoded simulasi
                'tunjangan' => 1500000,  // Hardcoded simulasi
                'status' => $pegawai->status_kepegawaian
            ]);
        } catch (\Exception $e) {
            // Abaikan jika status tidak valid
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $pegawai->id,
                'nama' => $pegawai->nama,
                'nip' => $pegawai->nip,
                'status' => $pegawai->status_kepegawaian,
                'unit_kerja' => $pegawai->unitKerja ? $pegawai->unitKerja->nama_unit : null,
                'remunerasi' => $remunerasi
            ]
        ], 200);
    }
}
