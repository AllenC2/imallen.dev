<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'storeContact'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// Autenticación unificada (debe ir arriba del catch-all)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Portal de cliente
Route::get('/portal', [PortalController::class, 'index'])
    ->middleware(['auth', 'cliente-only'])
    ->name('portal.index');
Route::get('/portal/{expediente}', [PortalController::class, 'show'])
    ->middleware(['auth', 'cliente-only'])
    ->name('portal.show');

Route::get('/{slug}', [HomeController::class, 'show'])->name('page.show');
