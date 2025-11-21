<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Resident\ComplaintController as ResidentComplaintController;
use App\Models\Unit;
use App\Models\Resident;
use App\Models\Complaint;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ==================== DASHBOARD UMUM (REDIRECTOR) ====================
Route::get('/dashboard', function () {
    // Cek jika user login
    if (auth()->check()) {
        // Jika Admin, lempar ke Dashboard Admin
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } 
        // Jika Resident (Warga), langsung ke halaman lapor komplain
        else {
            return redirect()->route('resident.complaints.index');
        }
    }
    // Default fallback
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==================== PROFILE ROUTES ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Admin Dashboard (Statistik)
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalUnits' => Unit::count(),
            'occupiedUnits' => Unit::where('status', 'Terisi')->count(),
            'totalResidents' => Resident::where('status', 'Aktif')->count(),
            'pendingComplaints' => Complaint::where('status', 'Pending')->count(),
        ]);
    })->name('dashboard');

    // 2. Unit Management (CRUD Unit)
    Route::resource('units', UnitController::class);

    // 3. Resident Management (CRUD Penghuni)
    Route::resource('residents', ResidentController::class);

    // 4. Complaint Management (Kelola Laporan)
    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::put('/complaints/{complaint}', [AdminComplaintController::class, 'update'])->name('complaints.update');
});

// ==================== RESIDENT ROUTES (PENGHUNI) ====================
Route::middleware(['auth', 'verified'])->prefix('resident')->name('resident.')->group(function () {
    
    // Fitur Lapor Komplain
    Route::get('/complaints', [ResidentComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints', [ResidentComplaintController::class, 'store'])->name('complaints.store');
});

require __DIR__.'/auth.php';