<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\TicketController as SuperadminTicketController;


Route::middleware('api.guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('api.auth')->group(function () {

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });

    Route::middleware('role:superadmin')->prefix('superadmin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');

        // Ticket CRUD - semua di 1 page
        Route::get('/ticket', [SuperadminTicketController::class, 'index'])->name('superadmin.ticket');
        Route::post('/ticket', [SuperadminTicketController::class, 'store'])->name('superadmin.ticket.store');
        Route::put('/ticket/{id}', [SuperadminTicketController::class, 'update'])->name('superadmin.ticket.update');
        Route::delete('/ticket/{id}', [SuperadminTicketController::class, 'destroy'])->name('superadmin.ticket.destroy');
    });
});
