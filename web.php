<?php
use App\Http\Controllers\indexFileController;

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

Route::get('/', function () {
    return view("imagic");
});

Route::get('/convert/{imageName?}/{imageType?}', function ($imageName, $imageType ) {
    return view("converter.convert", ['imageName' => $imageName, 'imageType' => $imageType]);
})->name('convert');

Route::get('/halo/{nama}', function ($nama) {
    echo "<h1?>Halo $nama</h1>";
});

Route::post("/indexFile", [indexFileController::class, 'indexFile']);

use App\Http\Controllers\PreConvert;
Route::post('/converted-image', [PreConvert::class, 'convert'])->name('converted-image');

// Download routes
use App\Http\Controllers\downloadController;
Route::get('/download', [downloadController::class, 'dwnController'])->name('download');

use App\Http\Controllers\shareController;
Route::get('/share', [shareController::class, 'share'])->name('share');


use App\Http\Controllers\AuthController;
// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Dashboard route
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/logout', function () {
    session()->flush(); // Menghapus semua data sesi

    return redirect('/'); // Mengarahkan pengguna ke halaman "/"
});
