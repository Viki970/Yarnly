<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/patterns/crochet', [\App\Http\Controllers\PatternController::class, 'crochet'])->name('patterns.crochet');
Route::get('/patterns/crochet/{category}', [\App\Http\Controllers\PatternController::class, 'crochetByCategory'])->name('patterns.crochet.category');
Route::get('/patterns/{pattern}/view', [\App\Http\Controllers\PatternController::class, 'view'])->name('patterns.view');
Route::get('/patterns/{pattern}/download', [\App\Http\Controllers\PatternController::class, 'download'])->name('patterns.download');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Pattern creation routes
    Route::get('/patterns/create', [\App\Http\Controllers\PatternController::class, 'create'])->name('patterns.create');
    Route::post('/patterns/store', [\App\Http\Controllers\PatternController::class, 'store'])->name('patterns.store');
    Route::get('/my-patterns', [\App\Http\Controllers\PatternController::class, 'myPatterns'])->name('my-patterns');
    
    // Collections routes
    Route::get('/my-collections', [\App\Http\Controllers\CollectionController::class, 'myCollections'])->name('my-collections');
    
    // Favorites routes
    Route::post('/patterns/{pattern}/toggle-favorite', [\App\Http\Controllers\PatternController::class, 'toggleFavorite'])->name('patterns.toggle-favorite');
    Route::get('/favorites', [\App\Http\Controllers\PatternController::class, 'favorites'])->name('favorites');
    
    // Collections routes
    Route::get('/my-collections', [\App\Http\Controllers\CollectionController::class, 'myCollections'])->name('my-collections');
});

require __DIR__.'/auth.php';
