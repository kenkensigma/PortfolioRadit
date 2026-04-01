<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
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
Route::post('/contact', function (Request $request): JsonResponse {
    $request->validate([
        'name'    => ['required', 'string', 'max:100'],
        'email'   => ['required', 'email:rfc,dns', 'max:200'],
        'message' => ['required', 'string', 'max:2000'],
    ]);
    return response()->json(['success' => true, 'message' => "Thank you! I'll be in touch shortly."]);
})->name('contact.send');

// ── AUTH ──────────────────────────────────────────────────────────────
Route::get('/admin/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login',  [AuthController::class, 'login']    )->name('login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout']   )->name('logout');