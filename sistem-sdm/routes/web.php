<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PegawaiWebController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai', [PegawaiWebController::class, 'index']);
