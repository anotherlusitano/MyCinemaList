<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserFavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);
Route::get('/movies/{movie}/staff', [MovieController::class, 'staff']);

Route::get('/people/{person}', [PersonController::class, 'show']);

Route::post('/movies/{movie}/favorite', [UserFavoriteController::class, 'favoriteMovie']);
Route::delete('/movies/{movie}/remove-favorite', [UserFavoriteController::class, 'removeFavoriteMovie']);

Route::post('/people/{person}/favorite', [UserFavoriteController::class, 'favoritePerson']);
Route::delete('/people/{person}/remove-favorite', [UserFavoriteController::class, 'removeFavoritePerson']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
