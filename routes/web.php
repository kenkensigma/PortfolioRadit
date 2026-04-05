<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;
use Illuminate\View\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes — Laravel 12
|--------------------------------------------------------------------------
*/

// ── PUBLIC PORTFOLIO ──────────────────────────────────────────────────
Route::get('/', function (): View {
    return view('pages.home');
})->name('home');

// Project detail page
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('project.show');

// Contact form
Route::post('/contact', [SendEmailController::class, 'send'])->name('contact.send');

// ── AUTH ──────────────────────────────────────────────────────────────
Route::get('/admin/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login',  [AuthController::class, 'login']    )->name('login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout']   )->name('logout');