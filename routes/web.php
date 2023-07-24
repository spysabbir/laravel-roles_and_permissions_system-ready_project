<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\PermissionController;
use App\Http\Controllers\Backend\Admin\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('permission', PermissionController::class);

Route::resource('role', RoleController::class);

Route::get('/assign/role/permission', [AdminController::class, 'AssignRolePermission'])->name('assign.role.permission');
Route::post('/assign/role/permission', [AdminController::class, 'AssignRolePermissionStore'])->name('assign.role.permission.store');
Route::get('/edit/role/permission/{id}', [AdminController::class, 'EditRolePermission'])->name('edit.role.permission');
Route::post('/edit/role/permission/{id}', [AdminController::class, 'UpdateRolePermission'])->name('edit.role.permission.update');
