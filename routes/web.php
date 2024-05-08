<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/get-server-data', [ApiController:: class, 'getServerData']);
Route::get('/get-total-players', [ApiController::class, 'getTotalPlayers']);
Route::get('/get-online-players', [ApiController::class, 'getOnlinePlayers']);
Route::get('/get-default-gold', [ApiController::class, 'getDefaultGold']);