<?php

use App\Http\Controllers\Api\TerapiController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.key')->group(function () {
    Route::post('terapi/kirim-hasil', [TerapiController::class, 'updateHasil']);
});
