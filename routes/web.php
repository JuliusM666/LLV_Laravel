<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Models\Comment;
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
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('locations', LocationController::class)

    ->only(['index', 'store','create','edit','update','destroy','show'])

    ->middleware(['auth', 'verified']);
  ;

  Route::post('/locations/moveImages',[LocationController::class,'moveImages']
)->middleware(['auth', 'verified'])->name('moveImages');

  Route::resource('comments', CommentController::class)

    ->only([ 'store','destroy'])

    ->middleware(['auth', 'verified']);
  ;
require __DIR__.'/auth.php';
