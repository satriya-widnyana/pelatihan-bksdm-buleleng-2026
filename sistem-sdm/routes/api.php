<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routing Pegawai
Route::get('/pegawai', [PegawaiController::class, 'index']);

// Routing Unit Kerja
use App\Http\Controllers\Api\UnitKerjaController;
Route::get('/unit-kerja', [UnitKerjaController::class, 'index']);

// Routing Demo Dokumentasi BNSP
use App\Http\Controllers\Api\PegawaiDocController;
Route::get('/pegawai-doc/{id?}', [PegawaiDocController::class, 'show']);

// Routing Demo Algoritma BNSP
use App\Http\Controllers\Api\DemoAlgoritmaController;

Route::prefix('demo')->group(function () {
    Route::get('/sorting', [DemoAlgoritmaController::class, 'sorting']);
    Route::get('/searching', [DemoAlgoritmaController::class, 'searching']);
    Route::get('/fibonacci', [DemoAlgoritmaController::class, 'fibonacci']);
    Route::get('/data-structure', [DemoAlgoritmaController::class, 'dataStructure']);
    Route::get('/web-context', [DemoAlgoritmaController::class, 'webContext']);
});