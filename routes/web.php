<?php
use App\Http\Controllers\MoviesManagementController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/bo/addMovies', [MoviesManagementController::class, 'create'])->name('bo.movies.create');
Route::post('/bo/movies', [MoviesManagementController::class, 'store'])->name('bo.movies.store');
Route::get('/bo/movies/{movie}/edit', [MoviesManagementController::class, 'edit'])->name('bo.movies.edit');
Route::put('/bo/movies/{movie}', [MoviesManagementController::class, 'update'])->name('bo.movies.update');
Route::delete('/bo/movies/{movie}', [MoviesManagementController::class, 'destroy'])->name('bo.movies.destroy');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/bo/movies', [MoviesManagementController::class, 'index'])->name('movies.management.index');
});
