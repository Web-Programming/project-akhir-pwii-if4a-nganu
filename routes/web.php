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
    return view('welcome');
});

Route::get('/index', function () {
    return view("converter.index");
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

use App\Http\Controllers\downloadController;
Route::get('/download', [downloadController::class, 'dwnController'])->name('download');

