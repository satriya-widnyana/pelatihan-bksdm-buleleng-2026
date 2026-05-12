<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pegawai', [PegawaiController::class, 'index']);

// Routing Demo Algoritma BNSP
use App\Http\Controllers\Api\DemoAlgoritmaController;

Route::prefix('demo')->group(function () {
    Route::get('/sorting', [DemoAlgoritmaController::class, 'sorting']);
    Route::get('/searching', [DemoAlgoritmaController::class, 'searching']);
    Route::get('/fibonacci', [DemoAlgoritmaController::class, 'fibonacci']);
    Route::get('/data-structure', [DemoAlgoritmaController::class, 'dataStructure']);
    Route::get('/web-context', [DemoAlgoritmaController::class, 'webContext']);
});