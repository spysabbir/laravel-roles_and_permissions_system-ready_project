<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::resource('permission', PermissionController::class);

    Route::resource('role', RoleController::class);

    Route::get('/assign/role/permission', [AdminController::class, 'AssignRolePermission'])->name('assign.role.permission');
    Route::post('/assign/role/permission', [AdminController::class, 'AssignRolePermissionStore'])->name('assign.role.permission.store');
    Route::get('/edit/role/permission/{id}', [AdminController::class, 'EditRolePermission'])->name('edit.role.permission');
    Route::post('/edit/role/permission/{id}', [AdminController::class, 'UpdateRolePermission'])->name('edit.role.permission.update');

    Route::get('/all/admin', [AdminController::class, 'AllAdmin'])->name('all.admin');
    Route::post('/admin/store', [AdminController::class, 'AdminStore'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'AdminEdit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [AdminController::class, 'AdminUpdate'])->name('admin.update');
});
