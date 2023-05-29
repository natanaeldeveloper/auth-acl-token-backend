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

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::apiResource('roles', App\Http\Controllers\RoleController::class);
    Route::apiResource('permissions', App\Http\Controllers\PermissionController::class);
    Route::apiResource('users', App\Http\Controllers\UserController::class);

    // rotas de permissões do papel.
    Route::prefix('roles/{role}/permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'redefine']);
    });
});
