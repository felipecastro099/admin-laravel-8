<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Users\PermissionController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::name('admin.auth.login')->get('/acessar', [AuthenticatedSessionController::class, 'create']);
        Route::name('admin.auth.access')->post('/acessar', [AuthenticatedSessionController::class, 'store']);
        Route::name('admin.auth.forgot')->get('/esqueci-a-senha', [PasswordResetLinkController::class, 'create']);
        Route::name('admin.auth.forgot-password')->post('/forgot-password', [PasswordResetLinkController::class, 'store']);
        Route::name('admin.auth.reset')->get('/atualize-a-senha/{token}', [NewPasswordController::class, 'create']);
        Route::name('admin.auth.reset-password')->post('/reset-password', [NewPasswordController::class, 'store']);
    });

    Route::middleware('auth')->group(function () {
        Route::name('admin.auth.verify')->get('/verify-email', [EmailVerificationPromptController::class, '__invoke']);
        Route::name('admin.auth.verify-email')->post('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke']);
        Route::name('admin.auth.verification.send')->post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1');
        Route::name('admin.password.confirm')->get('/confirm-password', [ConfirmablePasswordController::class, 'show']);
        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::name('admin.auth.logout')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        Route::prefix('permissoes')->group(function () {
            Route::name('admin.permissions.index')->get('/', [PermissionController::class, 'index']);
            Route::name('admin.permissions.create')->get('/adicionar', [PermissionController::class, 'create']);
            Route::name('admin.permissions.store')->post('/adicionar', [PermissionController::class, 'store']);
            Route::name('admin.permissions.edit')->get('/editar/{id}', [PermissionController::class, 'edit']);
            Route::name('admin.permissions.update')->put('/editar/{id}', [PermissionController::class, 'update']);
            Route::name('admin.permissions.destroy')->delete('/excluir/{id}', [PermissionController::class, 'destroy']);
        });
    });
});

require __DIR__ . '/auth.php';
