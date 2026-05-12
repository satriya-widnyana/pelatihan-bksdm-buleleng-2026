<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexPegawaiRequest;
use App\Services\PegawaiService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class PegawaiController extends Controller
{
    protected $pegawaiService;

    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
    }

    #[OA\Get(path: "/api/pegawai", summary: "Mengambil daftar Pegawai dengan filter, sort, dan paginasi", tags: ["Pegawai"])]
    #[OA\Parameter(name: "search", in: "query", required: false)]
    #[OA\Parameter(name: "per_page", in: "query", required: false)]
    #[OA\Response(response: 200, description: "Berhasil")]
    public function index(IndexPegawaiRequest $request): JsonResponse
    {
        $search  = $request->validated('search');
        $sorts   = $request->validated('sort') ?? [];
        $perPage = (int) $request->validated('per_page', 15);
        $page    = (int) $request->validated('page', 1);

        $paginatedData = $this->pegawaiService->getPaginatedPegawai($search, $sorts, $perPage, $page);

        return response()->json($paginatedData);
    }
}
