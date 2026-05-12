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
    public function show(int $id): JsonResponse
    {
        if ($id !== 1) {
            return response()->json(['status' => 'error'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => ['id' => 1, 'nama' => 'Budi Santoso', 'jabatan' => 'Analis Kepegawaian', 'remunerasi' => 5700000.0]
        ], 200);
    }
}
