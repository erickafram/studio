<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\CashflowController;
use App\Http\Controllers\Admin\AdminUserController;

// Rotas Públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rotas de Agendamento (públicas)
Route::get('/agendar', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/agendar', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/api/available-times', [AppointmentController::class, 'getAvailableTimes'])->name('api.available-times');
Route::get('/api/client-lookup', [AppointmentController::class, 'lookupClient'])->name('appointments.lookup-client');

// Rotas Admin (protegidas)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Serviços
    Route::resource('services', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);
    
    // Agendamentos
    Route::resource('appointments', AdminAppointmentController::class)->names([
        'index' => 'admin.appointments.index',
        'create' => 'admin.appointments.create',
        'store' => 'admin.appointments.store',
        'edit' => 'admin.appointments.edit',
        'update' => 'admin.appointments.update',
        'destroy' => 'admin.appointments.destroy',
    ]);
    Route::get('appointments/manage/pending', [AdminAppointmentController::class, 'manage'])->name('admin.appointments.manage');
    Route::post('appointments/{appointment}/confirm', [AdminAppointmentController::class, 'confirm'])->name('admin.appointments.confirm');
    
    // Usuários
    Route::resource('users', AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::get('users/search/quick', [AdminUserController::class, 'search'])->name('admin.users.search');
    
    // Estoque
    Route::resource('stock', StockController::class)->names([
        'index' => 'admin.stock.index',
        'create' => 'admin.stock.create',
        'store' => 'admin.stock.store',
        'edit' => 'admin.stock.edit',
        'update' => 'admin.stock.update',
        'destroy' => 'admin.stock.destroy',
    ]);
    Route::post('stock/{stock}/adjust', [StockController::class, 'adjustQuantity'])->name('admin.stock.adjust');
    
    // Fluxo de Caixa
    Route::resource('cashflow', CashflowController::class)->names([
        'index' => 'admin.cashflow.index',
        'create' => 'admin.cashflow.create',
        'store' => 'admin.cashflow.store',
        'edit' => 'admin.cashflow.edit',
        'update' => 'admin.cashflow.update',
        'destroy' => 'admin.cashflow.destroy',
    ]);
    Route::get('cashflow/report/daily', [CashflowController::class, 'dailyReport'])->name('admin.cashflow.daily-report');
});



