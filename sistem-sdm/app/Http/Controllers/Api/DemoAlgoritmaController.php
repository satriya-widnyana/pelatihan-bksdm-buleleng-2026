<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AlgoritmaService;
use Illuminate\Http\JsonResponse;

/**
 * Class DemoAlgoritmaController
 * 
 * Mengendalikan endpoint pengujian materi algoritma J.620100.022.02.
 */
class DemoAlgoritmaController extends Controller
{
    /**
     * @var AlgoritmaService
     */
    protected $algoritmaService;

    /**
     * @param AlgoritmaService $algoritmaService
     */
    public function __construct(AlgoritmaService $algoritmaService)
    {
        $this->algoritmaService = $algoritmaService;
    }

    /**
     * Helper pembungkus untuk menghitung durasi eksekusi dari service layer.
     *
     * @param callable $action Fungsi service yang dieksekusi
     * @param string $namaAlgoritma
     * @return JsonResponse
     */
    private function respondWithTiming(callable $action, string $namaAlgoritma): JsonResponse
    {
        $start = microtime(true);
        $hasilData = $action();
        $end = microtime(true);
        
        $timeMs = round(($end - $start) * 1000, 2);

        return response()->json([
            'demo_materi' => $namaAlgoritma,
            'waktu_eksekusi_total_ms' => $timeMs,
            'data' => $hasilData
        ]);
    }

    public function sorting(): JsonResponse
    {
        return $this->respondWithTiming(function () {
            return $this->algoritmaService->demoSorting();
        }, 'Demonstrasi Sorting (Elemen 2)');
    }

    public function searching(): JsonResponse
    {
        return $this->respondWithTiming(function () {
            return $this->algoritmaService->demoSearching('Cici');
        }, 'Demonstrasi Searching (Elemen 3)');
    }

    public function fibonacci(): JsonResponse
    {
        return $this->respondWithTiming(function () {
            // N = 20 agar naif recursion belum menyebabkan server lag berkepanjangan
            return $this->algoritmaService->demoFibonacci(20);
        }, 'Demonstrasi Rekursi & Dynamic Programming (Elemen 4)');
    }

    public function dataStructure(): JsonResponse
    {
        return $this->respondWithTiming(function () {
            return $this->algoritmaService->demoDataStructure();
        }, 'Demonstrasi Struktur Data (Elemen 5)');
    }

    public function webContext(): JsonResponse
    {
        return $this->respondWithTiming(function () {
            return $this->algoritmaService->demoWebContext();
        }, 'Demonstrasi Web Context & Caching (Elemen 6)');
    }
}
