<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Laravel is working!';
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    return redirect()->route($user && $user->role === 'admin' ? 'admin.dashboard' : 'user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/user/dashboard', [DashboardController::class, 'user'])
    ->middleware(['auth', 'verified'])
    ->name('user.dashboard');

Route::post('/tokens/create', [TokenController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('tokens.create');

Route::get('/weather', [DashboardController::class, 'weather'])
    ->middleware(['auth', 'verified'])
    ->name('weather.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
