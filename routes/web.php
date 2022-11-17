<?php

use App\Http\Controllers\mahasiswacontroller;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('mahasiswa', mahasiswacontroller::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['logincheck:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['logincheck:editor']], function () {
        Route::resource('editor', EditorController::class);
    });
});
Route::resource('produk', ProdukController::class);