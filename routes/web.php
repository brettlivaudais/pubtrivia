<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/locations', [LocationController::class,'index'])->name('locations.index');
Route::get('/location/new', [LocationController::class, 'create'])->name('locations.create');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
Route::get('/locations/{slug}', [LocationController::class, 'show'])->name('locations.show');
Route::get('/preview/{slug}', [LocationController::class, 'show'])->name('locations.preview');
Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');
//Route::delete('/locations/{id}', [LocationController::class, 'destroy'])->name('locations.destroy');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/profile/edit/', [UserController::class, 'edit'])->name('users.edit');
Route::put('/profile/update/', [UserController::class, 'update'])->name('users.update');
Route::get('/profile/{slug}', [UserController::class, 'show'])->name('users.show');
Route::get('/cities/{state}/{city}', [LocationController::class, 'city'])->name('locations.city');
Route::get('/host/{slug}', [LocationController::class, 'host'])->name('locations.host');
