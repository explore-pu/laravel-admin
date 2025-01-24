<?php

namespace Elegance\Admin\Traits;

use Elegance\Admin\Http\Controllers;
use Illuminate\Support\Facades\Route;

trait BuiltinRoutes
{
    /**
     * Register the laravel-admin builtin routes.
     *
     * @return void
     */
    public static function routes(): void
    {
        $authController = config('admin.auth.controller', Controllers\AuthController::class);

        // Guest routing
        Route::group(['middleware' => ['web', 'guest']], function () use ($authController) {
            // login
            Route::get('login', $authController . '@create')->name('login');
            Route::post('login', $authController . '@store');
        });

        Route::group(['middleware' => config('admin.route.middleware')], function () use ($authController) {
            // logout
            Route::get('logout', $authController . '@logout')->name('logout');

            // self setting
            Route::get('setting', $authController . '@edit')->name('setting');
            Route::put('setting', $authController . '@update')->name('setting.update');

            // users
            $userController = config('admin.database.user_controller', Controllers\UserController::class);
            Route::resource('users', $userController)->names('users');
            Route::put('users/{user}/restore', $userController . '@restore')->name('users.restore');
            Route::delete('users/{user}/delete', $userController . '@delete')->name('users.delete');
            Route::post('users/{user}/authorization',  $userController . '@authorization')->name('users.authorization');

            // roles
            $roleController = config('admin.database.role_controller', Controllers\RoleController::class);
            Route::resource('roles', $roleController)->names('roles');
            Route::put('roles/{role}/restore', $roleController . '@restore')->name('roles.restore');
            Route::delete('roles/{role}/delete', $roleController . '@delete')->name('roles.delete');
            Route::post('roles/{role}/authorization', $roleController . '@authorization')->name('roles.authorization');

            // permissions
            $permissionController = config('admin.databse.permission_controller', Controllers\PermissionController::class);
            Route::resource('permissions', $permissionController)->names('permissions');
            Route::put('permissions/{permission}/restore', $permissionController . '@restore')->name('permissions.restore');
            Route::delete('permissions/{permission}/delete', $permissionController . '@delete')->name('permissions.delete');
        });
    }
}
