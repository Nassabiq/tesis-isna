<?php

use App\Http\Controllers\DemografiController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\MasterDemografiController;
use App\Http\Controllers\MasterKuesionerController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DemografiController::class, 'index'])->name('dashboard');
    Route::post('/demografi', [DemografiController::class, 'store'])->name('demografi.post');

    Route::get('/isi-kuesioner', [KuesionerController::class, 'index'])->name('isi-kuesioner');
    Route::post('/isi-kuesioner', [KuesionerController::class, 'store'])->name('kuesioner.post');

    Route::get('/hasil-kuesioner', [KuesionerController::class, 'results'])->name('hasil-kuesioner');

    Route::get('/master/kuesioner', [MasterKuesionerController::class, 'index'])->name('master-kuesioner');
    Route::post('/master/kuesioner', [MasterKuesionerController::class, 'store'])->name('master-kuesioner.post');
    Route::get('/master/kuesioner/{id}', [MasterKuesionerController::class, 'edit'])->name('master-kuesioner.edit');
    Route::put('/master/kuesioner/{id}', [MasterKuesionerController::class, 'update'])->name('master-kuesioner.update');
    Route::delete('/master/kuesioner', [MasterKuesionerController::class, 'delete'])->name('master-kuesioner.delete');

    Route::get('/master/demografi', [MasterDemografiController::class, 'index'])->name('master-demografi');
    Route::post('/master/demografi', [MasterDemografiController::class, 'store'])->name('master-demografi.post');
    Route::get('/master/demografi/{id}', [MasterDemografiController::class, 'edit'])->name('master-demografi.edit');
    Route::put('/master/demografi/{id}', [MasterDemografiController::class, 'update'])->name('master-demografi.update');
    Route::delete('/master/demografi', [MasterDemografiController::class, 'delete'])->name('master-demografi.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/generate-pdf-analisis', [PDFController::class, 'generatePDFAnalisis'])->name('generate-pdf-analisis');
    Route::get('/generate-pdf-rekap', [PDFController::class, 'generatePDFRekap'])->name('generate-pdf-rekap');
});

require __DIR__ . '/auth.php';
