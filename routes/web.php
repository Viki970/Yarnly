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
    Route::delete('/patterns/{pattern}', [\App\Http\Controllers\PatternController::class, 'destroy'])->name('patterns.destroy');
    
    // Collections routes
    Route::get('/my-collections', [\App\Http\Controllers\CollectionController::class, 'myCollections'])->name('my-collections');
    Route::get('/collections/select-patterns', [\App\Http\Controllers\CollectionController::class, 'selectPatterns'])->name('collections.select-patterns');
    Route::get('/collections/create', [\App\Http\Controllers\CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections/store', [\App\Http\Controllers\CollectionController::class, 'store'])->name('collections.store');
    Route::post('/collections/{collection}/add-patterns', [\App\Http\Controllers\CollectionController::class, 'addPatternsToExisting'])->name('collections.add-patterns');
    Route::get('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');
    Route::get('/collections/{collection}/edit', [\App\Http\Controllers\CollectionController::class, 'edit'])->name('collections.edit');
    Route::put('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'update'])->name('collections.update');
    Route::delete('/collections/{collection}/remove-cover', [\App\Http\Controllers\CollectionController::class, 'removeCover'])->name('collections.remove-cover');
    Route::get('/collections/{collection}/edit-patterns', [\App\Http\Controllers\CollectionController::class, 'editPatterns'])->name('collections.edit-patterns');
    Route::post('/collections/{collection}/update-patterns', [\App\Http\Controllers\CollectionController::class, 'updatePatterns'])->name('collections.update-patterns');
    Route::get('/collections/{collection}/download-all', [\App\Http\Controllers\CollectionController::class, 'downloadAll'])->name('collections.downloadAll');
    Route::delete('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'destroy'])->name('collections.destroy');
    
    // Favorites routes
    Route::post('/patterns/{pattern}/toggle-favorite', [\App\Http\Controllers\PatternController::class, 'toggleFavorite'])->name('patterns.toggle-favorite');
    Route::get('/favorites', [\App\Http\Controllers\PatternController::class, 'favorites'])->name('favorites');
});

require __DIR__.'/auth.php';
