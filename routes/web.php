<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/patterns/crochet', [\App\Http\Controllers\PatternController::class, 'crochet'])->name('patterns.crochet');
Route::get('/patterns/crochet/{category}', [\App\Http\Controllers\PatternController::class, 'crochetByCategory'])->name('patterns.crochet.category');
Route::get('/patterns/{pattern}/view', [\App\Http\Controllers\PatternController::class, 'view'])->name('patterns.view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
