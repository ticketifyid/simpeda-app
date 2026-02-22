<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\TicketController as SuperadminTicketController;
use App\Http\Controllers\Superadmin\DiscountController as SuperadminDiscountController;
use App\Http\Controllers\Superadmin\OrderController as SuperadminOrderController;


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
        Route::get('/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.dashboard');

        // Ticket CRUD
        Route::get('/ticket', [SuperadminTicketController::class, 'index'])->name('superadmin.ticket');
        Route::post('/ticket', [SuperadminTicketController::class, 'store'])->name('superadmin.ticket.store');
        Route::put('/ticket/{id}', [SuperadminTicketController::class, 'update'])->name('superadmin.ticket.update');
        Route::delete('/ticket/{id}', [SuperadminTicketController::class, 'destroy'])->name('superadmin.ticket.destroy');

        // Discount CRUD
        Route::get('/discount', [SuperadminDiscountController::class, 'index'])->name('superadmin.discount');
        Route::post('/discount', [SuperadminDiscountController::class, 'store'])->name('superadmin.discount.store');
        Route::put('/discount/{id}', [SuperadminDiscountController::class, 'update'])->name('superadmin.discount.update');
        Route::delete('/discount/{id}', [SuperadminDiscountController::class, 'destroy'])->name('superadmin.discount.destroy');

        // Order — tambahan baru
        Route::get('/order', [SuperadminOrderController::class, 'index'])->name('superadmin.order');
        Route::put('/order/{id}/status', [SuperadminOrderController::class, 'updateStatus'])->name('superadmin.order.updateStatus');
        Route::delete('/order/{id}', [SuperadminOrderController::class, 'destroy'])->name('superadmin.order.destroy');
    });
});
