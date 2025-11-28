<?php

use App\Controllers\AdminController;
use App\Controllers\OrderController;
use PXP\Core\Lib\Route;

Route::get('/')->do(OrderController::class, 'index');
Route::post('/')->do(OrderController::class, 'action');

Route::get('/admin/{secret}')->do(AdminController::class, 'index');
Route::get('/admin/{secret}/analysis')->do(AdminController::class, 'analysis');
Route::post('/admin/{secret}/delete')->do(AdminController::class, 'destroy');
Route::post('/admin/{secret}/restore')->do(AdminController::class, 'restore');
Route::post('/admin/{secret}/toggle-paid')->do(AdminController::class, 'togglePaid');
Route::post('/admin/{secret}/toggle-accessibility')->do(AdminController::class, 'toggleAccessiblity');
