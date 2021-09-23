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
use App\Http\Controllers\Admin\Users\RoleController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Admin\Audit\AuditController;
use App\Http\Controllers\Admin\Analytics\AnalyticController;

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
        Route::name('admin.auth.logout')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        // Audit
        Route::prefix('auditoria')->group(function(){
            Route::name('admin.audits.index')->get('/', [AuditController::class, 'index']);
            Route::name('admin.audits.show')->get('/{id}', [AuditController::class, 'show']);
        });

        // Analytics
        Route::name('admin.analytics.index')->get('/acessos', [AnalyticController::class, 'index']);

        Route::prefix('permissoes')->group(function () {
            Route::name('admin.permissions.index')->get('/', [PermissionController::class, 'index']);
            Route::name('admin.permissions.create')->get('/adicionar', [PermissionController::class, 'create']);
            Route::name('admin.permissions.store')->post('/adicionar', [PermissionController::class, 'store']);
            Route::name('admin.permissions.edit')->get('/editar/{id}', [PermissionController::class, 'edit']);
            Route::name('admin.permissions.update')->put('/editar/{id}', [PermissionController::class, 'update']);
            Route::name('admin.permissions.destroy')->delete('/excluir/{id}', [PermissionController::class, 'destroy']);
        });

        // Roles
        Route::prefix('grupos')->group(function(){
            Route::name('admin.roles.index')->get('/', [RoleController::class, 'index']);
            Route::name('admin.roles.create')->get('/adicionar', [RoleController::class, 'create']);
            Route::name('admin.roles.store')->post('/adicionar', [RoleController::class, 'store']);
            Route::name('admin.roles.edit')->get('/editar/{id}', [RoleController::class, 'edit']);
            Route::name('admin.roles.update')->put('/editar/{id}', [RoleController::class, 'update']);
        });

        // Settings
        Route::prefix('configuracoes')->group(function(){
            Route::name('admin.settings.index')->get('/', [SettingController::class,'index']);
            Route::name('admin.settings.create')->get('/adicionar', [SettingController::class, 'create']);
            Route::name('admin.settings.store')->post('/adicionar', [SettingController::class, 'store']);
            Route::name('admin.settings.edit')->get('/editar/{id}', [SettingController::class, 'edit']);
            Route::name('admin.settings.update')->put('/editar/{id}', [SettingController::class, 'update']);
            Route::name('admin.settings.destroy')->delete('/excluir/{id}', [SettingController::class, 'destroy']);
        });
    });
});

//require __DIR__ . '/auth.php';
