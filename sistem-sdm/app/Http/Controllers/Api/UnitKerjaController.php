<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UnitKerjaService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class UnitKerjaController extends Controller
{
    protected $unitKerjaService;

    public function __construct(UnitKerjaService $unitKerjaService)
    {
        $this->unitKerjaService = $unitKerjaService;
    }

    #[OA\Get(path: "/api/unit-kerja", summary: "Mengambil daftar Unit Kerja", tags: ["Unit Kerja"])]
    #[OA\Response(response: 200, description: "Berhasil mengambil data")]
    public function index(): JsonResponse
    {
        $data = $this->unitKerjaService->getAllUnitKerja();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
}
