<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PegawaiService;
use Illuminate\Http\Request;

class PegawaiWebController extends Controller
{
    /**
     * @var PegawaiService
     */
    protected $pegawaiService;

    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
    }

    /**
     * Menampilkan halaman daftar pegawai.
     * Menggunakan ulang PegawaiService yang sama dengan API untuk memastikan 
     * business logic (termasuk caching dan Eager Loading) tetap konsisten.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = 10; // Tampilkan 10 data per halaman di versi Web
        
        // Memanggil service yang sama. array kosong [] untuk sorting default (ID desc)
        $paginatedData = $this->pegawaiService->getPaginatedPegawai($search, [], $perPage, (int) $request->get('page', 1));

        // Menambahkan parameter pencarian ke URL paginasi
        $paginatedData->appends(['search' => $search]);

        return view('pegawai', compact('paginatedData', 'search'));
    }
}
