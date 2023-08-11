<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\TopController;

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
//     return view('user.welcome');
// });

Route::get('/top',[TopController::class,'index'])
->name('top.index');


Route::middleware('auth:users')
->group(function(){
    Route::get('/',[ItemController::class,'index'])
    ->name('items.index');
    Route::get('show/{item}',[ItemController::class,'show'])
    ->name('items.show');
});

Route::prefix('cart')->middleware('auth:users')->group(function(){
    Route::get('/',[CartController::class,'index'])->name('cart.index');
    Route::post('/add',[CartController::class,'add'])->name('cart.add');
    Route::post('delete/{item}',[CartController::class,'delete'])
    ->name('cart.delete');
    Route::get('checkout',[CartController::class,'checkout'])->name('cart.checkout');
    Route::get('success',[CartController::class,'success'])->name('cart.success');
    Route::get('cancel',[CartController::class,'cancel'])->name('cart.cancel');
});

// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth:users', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
