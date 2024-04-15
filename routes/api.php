<?php

use App\Http\Controllers\Api\{
    HotelsController
};
use Illuminate\Support\Facades\Route;

Route::get('/hotels', [HotelsController::class, 'index']);
Route::get('/hotels/{id}', [HotelsController::class, 'show']);
Route::post('/hotels', [HotelsController::class, 'create']);
Route::delete('/hotels/{id}', [HotelsController::class, 'delete']);
Route::put('/hotels/{id}', [HotelsController::class, 'update']);

Route::get('/', function (){
    return response()->json([
        'success' => true,
    ]);
});