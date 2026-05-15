<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HewanController;
use App\Models\Hewan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $hewan = Hewan::latest()->take(6)->get();
    return view('welcome', compact('hewan'));
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'total_hewan' => Hewan::count(),
        'total_user' => \App\Models\User::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/hewan', [HewanController::class, 'index'])->name('hewan.index');
    Route::get('/hewan/{id}', [HewanController::class, 'show'])->name('hewan.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/hewan/create', [HewanController::class, 'create'])->name('hewan.create');
    Route::post('/hewan/store', [HewanController::class, 'store'])->name('hewan.store');
    Route::get('/hewan/edit/{id}', [HewanController::class, 'edit'])->name('hewan.edit');
    Route::put('/hewan/update/{id}', [HewanController::class, 'update'])->name('hewan.update');
    Route::delete('/hewan/delete/{id}', [HewanController::class, 'destroy'])->name('hewan.destroy');
});
require __DIR__.'/auth.php';
