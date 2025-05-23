<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','roleManager:customer'])->name('dashboard');



Route::middleware(['auth', 'verified', 'roleManager:admin'])->prefix('admin')->group(function() {
    Route::controller(AdminMainController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('admin');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index')->name('admin.category');
        Route::post('/category/store', 'store')->name('admin.category.store');
        Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit');
        Route::post('/category/update/{id}', 'update')->name('admin.category.update');
        Route::get('/category/delete/{id}', 'destroy')->name('admin.category.delete');
    });
});





Route::get('/vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified','roleManager:vendor'])->name('vendor');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
