<?php

use App\Http\Controllers\DemografiController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DemografiController::class, 'index'])->name('dashboard');
    Route::post('/demografi', [DemografiController::class, 'store'])->name('demografi.post');

    Route::get('/isi-kuesioner', [KuesionerController::class, 'index'])->name('isi-kuesioner');
    Route::post('/isi-kuesioner', [KuesionerController::class, 'store'])->name('kuesioner.post');

    Route::get('/hasil-kuesioner', [KuesionerController::class, 'results'])->name('hasil-kuesioner');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
