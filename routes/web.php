<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\AssistanceController;

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
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/confirm-assistance', [AssistanceController::class, 'store'])->name('confirm-assistance');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::post('/admin/login', [AdminController::class, 'auth'])->name('admin.login');

Route::get('/download-csv', [CSVController::class, 'download'])->name('download.csv');
Route::get('/download-pdf', [PDFController::class, 'download'])->name('download.pdf');

Route::post('/songs', [SpotifyController::class, 'getSongs'])->name('songs');
Route::get('/spotify/authorize', [SpotifyController::class, 'redirectToSpotify'])->name('spotify.authorize');
Route::get('/spotify/callback', [SpotifyController::class, 'handleSpotifyCallback'])->name('spotify.callback');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/administrator', [AdminController::class, 'admin'])->name('admin.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
