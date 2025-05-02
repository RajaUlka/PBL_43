<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    // Mengambil user dengan ID 1
    $user = User::find(1);
    
    return view('user.index', ['user' => $user]);
});