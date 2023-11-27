<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ListingsController::class, 'index']);
Route::get('/home', [ListingsController::class, 'index'])->name('home');
Route::get('/show/{id}', [ListingsController::class, 'show']);


Route::middleware(['auth'])->group(function () {
Route::get('/manage', [ListingsController::class, 'manage']);
Route::get('/create', [ListingsController::class, 'create'])->name('create');
Route::post('/store', [ListingsController::class, 'store'])->name('store');
Route::get('/edit/{id}', [ListingsController::class, 'edit']);
Route::put('/update/{id}', [ListingsController::class, 'update'])->name('update/{id}');
Route::delete('/delete/{id}', [ListingsController::class, 'delete']);
});


Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/user/create', [UserController::class, 'store']);
Route::post('/user/login', [UserController::class, 'auth']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');




