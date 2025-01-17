<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'getPets'])->name('pets.index');
Route::get('/pets/create', [PetController::class, 'createForm'])->name('pets.create');
Route::get('/pets/{id}', [PetController::class, 'findPetById'])->name('pets.show');
Route::post('/pets', [PetController::class, 'createPet'])->name('pets.store');
Route::get('/pets/{id}/edit', [PetController::class, 'editPet'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'updatePet'])->name('pets.update');
Route::delete('/pets/{id}', [PetController::class, 'destroyPet'])->name('pets.destroy');
