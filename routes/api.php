<?php

use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureIpAddressIsValid;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::middleware([EnsureIpAddressIsValid::class,'throttle:api'])->get('/products',[ProductController::class, 'index']);
