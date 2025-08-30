<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', CheckUserStatus::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');    
    Route::resource('users', UserController::class);
    Route::resource('terms', TermsController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('banners', BannerController::class);
});