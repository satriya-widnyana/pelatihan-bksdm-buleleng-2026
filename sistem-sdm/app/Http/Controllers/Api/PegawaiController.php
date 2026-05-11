<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexPegawaiRequest;
use App\Services\PegawaiService;
use Illuminate\Http\JsonResponse;

/**
 * Class PegawaiController
 * 
 * Mengatur lalu lintas data untuk entitas Pegawai.
 */
class PegawaiController extends Controller
{
    /**
     * @var PegawaiService
     */
    protected $pegawaiService;

    /**
     * PegawaiController constructor.
     * 
     * @param PegawaiService $pegawaiService
     */
    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
    }

    /**
     * @OA\Get(
     *     path="/api/pegawai",
     *     summary="Mengambil daftar Pegawai dengan filter, sort, dan paginasi",
     *     description="Endpoint yang sangat dioptimasi (Cached) untuk melayani pembacaan data (Dosen & Staf).",
     *     operationId="getPegawaiList",
     *     tags={"Pegawai"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Kata kunci pencarian bebas (Mencakup Nama, NIP, Status)",
     *         required=false,
     *         @OA\Schema(type="string", example="Budi")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Batasan jumlah item per halaman. Maks: 100",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operasi berhasil",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="nama", type="string", example="Budi Santoso"),
     *                     @OA\Property(property="nip", type="string", example="198001012005011001")
     *                 )
     *             ),
     *             @OA\Property(property="meta", type="object", description="Metadata paginasi")
     *         )
     *     )
     * )
     *
     * @param IndexPegawaiRequest $request
     * @return JsonResponse
     */
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
