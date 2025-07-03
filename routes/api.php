<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DataAlatController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/data-alat', [DataAlatController::class, 'store']);
Route::get('/data-alat', [DataAlatController::class, 'index']);