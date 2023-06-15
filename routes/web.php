<?php
use App\Http\Controllers\indexFileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreConvert;
use App\Http\Controllers\downloadController;
use App\Http\Controllers\HapusFotoController;
use App\Http\Controllers\ConperterController;

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

Route::get('/home', [AuthController::class, 'home'])->name('home')->middleware('auth');
Route::get('/', [AuthController::class, 'awal'])->name('awal');

// Route::view('/', 'imagic2')->name('awal');


Route::get('/convert/{imageName?}/{imageType?}', function ($imageName, $imageType ) {
    return view("converter.convert", ['imageName' => $imageName, 'imageType' => $imageType]);
})->name('convert');

Route::get('/halo/{nama}', function ($nama) {
    echo "<h1?>Halo $nama</h1>";
});

Route::post("/indexFile", [ConperterController::class, 'indexFile']);

Route::post('/converted-image', [ConperterController::class, 'convert'])->name('converted-image');

// Download routes
Route::get('/download', [ConperterController::class, 'dwnController'])->name('download');

use App\Http\Controllers\shareController;
Route::get('/share', [shareController::class, 'share'])->name('share');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Dashboard route
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/hapusFoto/{nama}', [HapusFotoController::class, 'hapusFoto'])->name('hapusFoto');

Route::get('/hapusFoto/{nama}', [ConperterController::class, 'hapusFoto'])->name('hapusFoto');

Route::get('/index/{tipe}', [ConperterController::class, 'indexCtr'])->name('index');
