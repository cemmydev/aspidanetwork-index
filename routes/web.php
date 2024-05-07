<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/get-server-data', [ApiController:: class, 'getServerData']);