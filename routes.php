<?php

use App\Controllers\AdminController;
use App\Controllers\LoginController;
use App\Controllers\OrderController;
use PXP\Http\Controllers\AssetController;
use PXP\Http\Middleware\InteractiveAuth;
use PXP\Router\Route;

Route::get('/')->do(OrderController::class, 'index')->name('main');
Route::post('/orders')->do(OrderController::class, 'action')->name('store');

Route::group(
    Route::get('/orders')->do(AdminController::class, 'index')->name('orders'),
    Route::get('/orders/trash')->do(AdminController::class, 'trash')->name('trash'),
    Route::post('/orders/{id}/delete')->do(AdminController::class, 'destroy')->name('delete'),
    Route::post('/orders/{id}/restore')->do(AdminController::class, 'restore')->name('restore'),
    Route::post('/orders/{id}/toggle-paid')->do(AdminController::class, 'togglePaid')->name('toggle-paid'),

    Route::get('/admin/analysis')->do(AdminController::class, 'analysis')->name('analysis'),
    Route::post('/admin/toggle-access')->do(AdminController::class, 'toggleAccess')->name('toggle-access'),
)
    ->middleware(InteractiveAuth::class);

Route::get('/login')->do(LoginController::class, 'form');
Route::post('/login')->do(LoginController::class, 'login');

Route::get('/logout')->do(LoginController::class, 'logout')->name('logout');
Route::post('/logout')->do(LoginController::class, 'logout');

Route::get('/css/{file}')->do(AssetController::class, 'css')->name('css');
