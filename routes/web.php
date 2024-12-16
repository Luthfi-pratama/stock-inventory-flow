<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SPVController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('auth/login');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('dashboard/manager', [ManagerController::class, 'index'])->name('manager.dashboard-mngr');
    Route::get('/cetak-data', [ManagerController::class, 'cetakData'])->name('cetak-data');
    // Preview PDF
    Route::get('/preview-pdf', [ManagerController::class, 'previewData'])->name('preview-pdf');
});


//Route SPV
Route::middleware(['auth', 'role:spv'])->group(function () {
    Route::get('dashboard/spv', [SPVController::class, 'index'])->name('spv.dashboard');
    Route::get('/dashboard/spv/master', [SPVController::class, 'master'])->name('spv.master');
    // Route untuk menyetujui barang (status pending menjadi approved)
    Route::post('/dashboard/spv/approve/{id}', [SPVController::class, 'approve'])->name('spv.approve');

    // Routes untuk menampilkan supplier dan kategori
    Route::get('/dashboard/spv/suppliers', [SupplierController::class, 'suppliers'])->name('spv.supplier');
    Route::get('/dashboard/spv/categories', [CategoryController::class, 'categories'])->name('spv.category');
    Route::post('/dashboard/spv/add-supplier', [SupplierController::class, 'addSupplier'])->name('spv.addSupplier');
    Route::post('/dashboard/spv/add-category', [CategoryController::class, 'addCategory'])->name('spv.addCategory');

    // Route update
    Route::get('{id}/edit-stock', [SPVController::class, 'edit'])->name('spv.edit.stock');
    Route::post('/dashboard/update-stock/{id}', [SPVController::class, 'update'])->name('spv.update.stock');

    // ROute Delete
    Route::delete('/spv/supplier/destroy/{id}', [SupplierController::class, 'destroy'])->name('spv.destroy');
    Route::delete('/spv/master-data/destroy/{id}', [SPVController::class, 'destroy'])->name('spv.master.destroy');
    Route::delete('/spv/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('spv.category.destroy');
});

//Route Staff
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('dashboard/staff', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('dashboard/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/dashboard/staff/create', [StaffController::class, 'store'])->name('staff.store');
});


require __DIR__ . '/auth.php';
