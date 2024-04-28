<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/short', [\App\Http\Controllers\ShortUrlController::class, 'short'])->name('short.url');
Route::get('/{massege}', [\App\Http\Controllers\ShortUrlController::class, 'massege'])->name('short.url.massege');
//Route::get('/{short_url}', [\App\Http\Controllers\ShortUrlController::class, 'redirect'])->name('short.url.redirect');
