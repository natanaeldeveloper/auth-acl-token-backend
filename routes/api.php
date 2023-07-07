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

    Route::apiResource('roles', App\Http\Controllers\RoleController::class)->names('roles');
    Route::apiResource('permissions', App\Http\Controllers\PermissionController::class)->names('permissions');
    Route::apiResource('users', App\Http\Controllers\UserController::class)->names('users');

    // rotas de permissões do papel.
    Route::prefix('roles/{role}/permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotRoleToPermissionController::class, 'redefine']);
    });

    // rotas de usuários do papel.
    Route::prefix('roles/{role}/users')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotRoleToUserController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotRoleToUserController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotRoleToUserController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotRoleToUserController::class, 'redefine']);
    });

    // rotas de permissões do usuário.
    Route::prefix('users/{user}/permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotUserToPermissionController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotUserToPermissionController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotUserToPermissionController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotUserToPermissionController::class, 'redefine']);
    });

    // rotas de papeis do usuário.
    Route::prefix('users/{user}/roles')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotUserToRoleController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotUserToRoleController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotUserToRoleController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotUserToRoleController::class, 'redefine']);
    });

    // rotas de papeis da permissão.
    Route::prefix('permissions/{permission}/roles')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotPermissionToRoleController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotPermissionToRoleController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotPermissionToRoleController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotPermissionToRoleController::class, 'redefine']);
    });

    // rotas de usuários da permissão.
    Route::prefix('permissions/{permission}/users')->group(function () {
        Route::get('/', [App\Http\Controllers\Pivot\PivotPermissionToUserController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Pivot\PivotPermissionToUserController::class, 'store']);
        Route::delete('/', [App\Http\Controllers\Pivot\PivotPermissionToUserController::class, 'remove']);
        Route::post('redefine', [App\Http\Controllers\Pivot\PivotPermissionToUserController::class, 'redefine']);
    });

    // rotas de tipo de anexo
    Route::apiResource('tipos-anexos', App\Http\Controllers\TipoAnexoController::class)->names('tipoAnexo');
});
