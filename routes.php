<?php

use App\Controllers\AdminController;
use App\Controllers\OrderController;
use App\Controllers\LoginController;
use PXP\Http\Controllers\AssetController;
use PXP\Router\Route;
use PXP\Http\Middleware\InteractiveAuth;

Route::get('/')->do(OrderController::class, 'index');
Route::post('/')->do(OrderController::class, 'action');

Route::group(
    Route::get('/admin')->do(AdminController::class, 'index'),
    Route::get('/admin/analysis')->do(AdminController::class, 'analysis'),
    Route::post('/admin/delete')->do(AdminController::class, 'destroy'),
    Route::post('/admin/restore')->do(AdminController::class, 'restore'),
    Route::post('/admin/toggle-paid')->do(AdminController::class, 'togglePaid'),
    Route::post('/admin/toggle-accessibility')->do(AdminController::class, 'toggleAccessiblity'),
)
    ->middleware(InteractiveAuth::class);

Route::get('/login')->do(LoginController::class, 'form');
Route::post('/login')->do(LoginController::class, 'login');

Route::get('/logout')->do(LoginController::class, 'logout');
Route::post('/logout')->do(LoginController::class, 'logout');

Route::get('/css/{file}')->do(AssetController::class, 'css');
