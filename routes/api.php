<?php

use App\Http\Controllers\Api\HotelsController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\RoomsController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// Rotas protegidas por autenticação
Route::middleware(['auth:sanctum'])->group(function(){

    // Rotas da API para hotéis
    Route::get('/api/hotels', [HotelsController::class, 'index']);
    Route::get('/api/hotels/{id}', [HotelsController::class, 'show']);
    Route::post('/api/hotels', [HotelsController::class, 'create']);
    Route::delete('/api/hotels/{id}', [HotelsController::class, 'delete']);
    Route::put('/api/hotels/{id}', [HotelsController::class, 'update']);

    // Rotas da API para quartos
    Route::get('/hotels/{id}/rooms', [RoomsController::class, 'index']);
    Route::get('/rooms/{id}', [RoomsController::class, 'show']);
    Route::post('/rooms', [RoomsController::class, 'create']);
    Route::delete('/rooms/{id}', [RoomsController::class, 'delete']);
    Route::put('/rooms/{id}', [RoomsController::class, 'update']);

    // Rota hotéis para a view Blade que contém o componente Livewire
    Route::get('/hotels', function () {
        return view('livewire.hotels.index');
    })->name('hotels.index');
    Route::get('/hotels/{id}', function () {
        return view('livewire.hotels.show');
    })->name('hotels.show');
    Route::post('/hotels', function () {
        return view('livewire.hotels.create');
    })->name('hotels.create');
    Route::delete('/hotels/{id}', function () {
        return view('livewire.hotels.delete');
    })->name('hotels.delete');
    Route::put('/hotels/{id}', function () {
        return view('livewire.hotels.update');
    })->name('hotels.update');

});

// Rota de boas-vindas
Route::get('/', function (){
    return response()->json([
        'success' => true,
    ]);
});
