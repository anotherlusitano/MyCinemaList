<?php

use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserFavoriteController;
use App\Http\Controllers\UserMovieProgressController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);
Route::get('/movies/{movie}/staff', [MovieController::class, 'staff']);
Route::get('/movies/{movie}/reviews', [ReviewController::class, 'movieReviews']);

Route::post('/reviews/create', [ReviewController::class, 'store']);
Route::patch('/reviews/{review}/update', [ReviewController::class, 'update']);
Route::delete('/reviews/{review}/destroy', [ReviewController::class, 'destroy']);

Route::get('/people/{person}', [PersonController::class, 'show']);

Route::post('/movies/{movie}/favorite', [UserFavoriteController::class, 'favoriteMovie']);
Route::delete('/movies/{movie}/remove-favorite', [UserFavoriteController::class, 'removeFavoriteMovie']);

Route::post('/people/{person}/favorite', [UserFavoriteController::class, 'favoritePerson']);
Route::delete('/people/{person}/remove-favorite', [UserFavoriteController::class, 'removeFavoritePerson']);

Route::post('/user-movie-progress', [UserMovieProgressController::class, 'store'])->name('user-movie-progress.store');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/users/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/users/{user}/reviews', [ReviewController::class, 'userReviews']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/backoffice', [BackofficeController::class, 'index']);

    Route::get('/backoffice/staff', [BackofficeController::class, 'staff'])->name('bo-search-staff');
    Route::get('/backoffice/staff/{person}/roles', [BackofficeController::class, 'staff_roles']);
    Route::get('/backoffice/staff/{person}/roles/add', [BackofficeController::class, 'add_roles'])->name('search_movies');

    Route::delete('/people/{person}/destroy', [BackofficeController::class, 'destroy_person']);
    Route::delete('/staff/{staff}/destroy', [BackofficeController::class, 'destroy_staff']);
    Route::get('/backoffice/people/{person}/edit', [BackofficeController::class, 'edit_person']);
    Route::patch('/backoffice/people/{person}/update', [BackofficeController::class, 'update_person'])->name('update-person');
    Route::patch('/backoffice/staff/{staff}/update', [BackofficeController::class, 'update_staff'])->name('update-staff');
});

require __DIR__ . '/auth.php';
