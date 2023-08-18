<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendPasswordResetEmail']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::apiResource('roles', App\Http\Controllers\ACL\RoleController::class)->names('role');
    Route::apiResource('permissions', App\Http\Controllers\ACL\PermissionController::class)->names('permission');
    Route::apiResource('users', App\Http\Controllers\UserController::class)->names('user');

    // rotas de permissões do papel.
    Route::prefix('roles/{role}/permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\ACL\PivotRoleToPermissionController::class, 'index'])->name('role.permission.index');
        Route::post('/', [App\Http\Controllers\ACL\PivotRoleToPermissionController::class, 'store'])->name('role.permission.store');
        Route::delete('/', [App\Http\Controllers\ACL\PivotRoleToPermissionController::class, 'remove'])->name('role.permission.remove');
        Route::post('redefine', [App\Http\Controllers\ACL\PivotRoleToPermissionController::class, 'redefine'])->name('role.permission.redefine');
    });

    // rotas de usuários do papel.
    Route::prefix('roles/{role}/users')->group(function () {
        Route::get('/', [App\Http\Controllers\ACL\PivotRoleToUserController::class, 'index'])->name('role.user.index');
        Route::post('/', [App\Http\Controllers\ACL\PivotRoleToUserController::class, 'store'])->name('role.user.store');
        Route::delete('/', [App\Http\Controllers\ACL\PivotRoleToUserController::class, 'remove'])->name('role.user.remove');
        Route::post('redefine', [App\Http\Controllers\ACL\PivotRoleToUserController::class, 'redefine'])->name('role.user.redefine');
    });

    // rotas de permissões do usuário.
    Route::prefix('users/{user}/permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\ACL\PivotUserToPermissionController::class, 'index'])->name('user.permission.index');
        Route::post('/', [App\Http\Controllers\ACL\PivotUserToPermissionController::class, 'store'])->name('user.permission.store');
        Route::delete('/', [App\Http\Controllers\ACL\PivotUserToPermissionController::class, 'remove'])->name('user.permission.remove');
        Route::post('redefine', [App\Http\Controllers\ACL\PivotUserToPermissionController::class, 'redefine'])->name('user.permission.redefine');
    });

    // rotas de papeis do usuário.
    Route::prefix('users/{user}/roles')->group(function () {
        Route::get('/', [App\Http\Controllers\ACL\PivotUserToRoleController::class, 'index'])->name('user.role.index');
        Route::post('/', [App\Http\Controllers\ACL\PivotUserToRoleController::class, 'store'])->name('user.role.store');
        Route::delete('/', [App\Http\Controllers\ACL\PivotUserToRoleController::class, 'remove'])->name('user.role.remove');
        Route::post('redefine', [App\Http\Controllers\ACL\PivotUserToRoleController::class, 'redefine'])->name('user.role.redefine');
    });

    // rotas de papeis da permissão.
    Route::prefix('permissions/{permission}/roles')->group(function () {
        Route::get('/', [App\Http\Controllers\ACL\PivotPermissionToRoleController::class, 'index'])->name('permission.role.index');
        Route::post('/', [App\Http\Controllers\ACL\PivotPermissionToRoleController::class, 'store'])->name('permission.role.store');
        Route::delete('/', [App\Http\Controllers\ACL\PivotPermissionToRoleController::class, 'remove'])->name('permission.role.remove');
        Route::post('redefine', [App\Http\Controllers\ACL\PivotPermissionToRoleController::class, 'redefine'])->name('permission.role.redefine');
    });

    // rotas de usuários da permissão.
    Route::prefix('permissions/{permission}/users')->group(function () {
        Route::get('/', [App\Http\Controllers\ACL\PivotPermissionToUserController::class, 'index'])->name('permission.user.index');
        Route::post('/', [App\Http\Controllers\ACL\PivotPermissionToUserController::class, 'store'])->name('permission.user.store');
        Route::delete('/', [App\Http\Controllers\ACL\PivotPermissionToUserController::class, 'remove'])->name('permission.user.remove');
        Route::post('redefine', [App\Http\Controllers\ACL\PivotPermissionToUserController::class, 'redefine'])->name('permission.user.redefine');
    });

});
