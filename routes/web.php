<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController; // <--- PASTIKAN INI ADA

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

    // --- INI RUTE YANG TADI HILANG ---
    // Kita beri nama 'units.index' agar tombol navigasi mengenalinya
    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
});

require __DIR__.'/auth.php';