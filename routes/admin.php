<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminController::class, 'login'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [AdminController::class, 'passwordRequest'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [AdminController::class, 'passwordReset'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('confirm-password', [AdminController::class, 'passwordConfirm'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::resource('role', RoleController::class);

        Route::resource('permission', PermissionController::class);

        Route::resource('role-permission', RolePermissionController::class);

        Route::get('/all/admin', [AdminController::class, 'AllAdmin'])->name('all.admin');
        Route::post('/admin/store', [AdminController::class, 'AdminStore'])->name('admin.store');
        Route::get('/admin/edit/{id}', [AdminController::class, 'AdminEdit'])->name('admin.edit');
        Route::post('/admin/update/{id}', [AdminController::class, 'AdminUpdate'])->name('admin.update');
    });

});
