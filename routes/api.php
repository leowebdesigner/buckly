<?php

use App\Http\Controllers\Api\{
    HotelsController
};
use Illuminate\Support\Facades\Route;

Route::get('/hotels', [HotelsController::class, 'index']);
Route::get('/hotels/{id}', [HotelsController::class, 'show']);

Route::get('/', function (){
    return response()->json([
        'success' => true,
    ]);
});