<?php

use App\Controllers\AdminController;
use App\Controllers\MyController;
use App\Controllers\OrderController;
use PXP\Auth\Middleware\RequireAdmin;
use PXP\Auth\Middleware\VerifiedEmail;
use PXP\Auth\Controllers\LoginController;
use PXP\Auth\Controllers\RegisterController;
use PXP\Auth\Controllers\VerificationController;
use PXP\Http\Controllers\AssetController;
use PXP\Auth\Middleware\InteractiveAuth;
use PXP\Router\Route;

Route::get('/')->do(OrderController::class, 'index')->name('main');
Route::post('/orders')->do(OrderController::class, 'action')->name('store');

Route::get('/register')->do(RegisterController::class, 'form')->name('register');
Route::post('/register')->do(RegisterController::class, 'register');

Route::get('/verify')->do(VerificationController::class, 'verify')->name('verify');

Route::get('/login')->do(LoginController::class, 'form')->name('login');
Route::post('/login')->do(LoginController::class, 'login');

Route::get('/my')->do(MyController::class, 'index')->name('my')
    ->middleware(InteractiveAuth::class)
    ->middleware(VerifiedEmail::class);

Route::group(
    Route::get('/logout')->do(LoginController::class, 'logout')->name('logout'),
    Route::post('/logout')->do(LoginController::class, 'logout'),
)
    ->middleware(InteractiveAuth::class);

Route::group(
    Route::get('/orders')->do(AdminController::class, 'index')->name('orders'),
    Route::get('/orders/trash')->do(AdminController::class, 'trash')->name('trash'),
    Route::get('/orders/archived')->do(AdminController::class, 'archived')->name('archived'),

    Route::post('/orders/{id}/archive')->do(AdminController::class, 'archive')->name('archive'),
    Route::post('/orders/{id}/unarchive')->do(AdminController::class, 'unarchive')->name('unarchive'),

    Route::post('/orders/{id}/delete')->do(AdminController::class, 'destroy')->name('delete'),
    Route::post('/orders/{id}/restore')->do(AdminController::class, 'restore')->name('restore'),
    Route::post('/orders/{id}/toggle-paid')->do(AdminController::class, 'togglePaid')->name('toggle-paid'),

    Route::get('/analysis')->do(AdminController::class, 'analysis')->name('analysis'),

    Route::post('/toggle-access')->do(AdminController::class, 'toggleAccess')->name('toggle-access'),
)
    ->middleware(InteractiveAuth::class)
    ->middleware(VerifiedEmail::class)
    ->middleware(RequireAdmin::class);

Route::get('/css/{file}')->do(AssetController::class, 'css')->name('css');
