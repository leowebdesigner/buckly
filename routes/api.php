<?php

use App\Http\Controllers\Api\HotelsController;
use App\Http\Controllers\Api\RoomsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){

Route::get('/hotels', [HotelsController::class, 'index']);
Route::get('/hotels/{id}', [HotelsController::class, 'show']);
Route::post('/hotels', [HotelsController::class, 'create']);
Route::delete('/hotels/{id}', [HotelsController::class, 'delete']);
Route::put('/hotels/{id}', [HotelsController::class, 'update']);

Route::get('/hotels/{id}/rooms', [RoomsController::class, 'index']);
Route::get('/rooms/{id}', [RoomsController::class, 'show']);
Route::post('/rooms', [RoomsController::class, 'create']);
Route::delete('/rooms/{id}', [RoomsController::class, 'delete']);
Route::put('/rooms/{id}', [RoomsController::class, 'update']);

});

Route::get('/', function (){
    return response()->json([
        'success' => true,
    ]);
});