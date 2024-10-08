<?php

namespace Elegant\Utils\Traits;

use Illuminate\Support\Facades\Route;

trait BuiltinRoutes
{
    /**
     * Register the laravel-admin builtin routes.
     *
     * @return void
     */
    public function routes()
    {
        Route::group(['namespace' => config('elegant-utils.admin.route.namespace')], function () {
            // login
            Route::middleware('web')->get('login', 'AuthController@getLogin')->name('login');
            Route::middleware('web')->post('login', 'AuthController@postLogin')->name('login.submit');

            Route::group(['middleware' => config('elegant-utils.admin.route.middleware')], function () {
                // logout
                Route::get('logout', 'AuthController@getLogout')->name('logout');
                // self setting
                Route::get('setting', 'AuthController@getSetting')->name('setting');
                Route::put('setting', 'AuthController@putSetting')->name('setting.update');

                // auth_users
                Route::resource('auth/users', 'AuthUserController')->names('auth_users');
                Route::put('auth/users/{user}/restore', 'AuthUserController@restore')->name('auth_users.restore');
                Route::delete('auth/users/{user}/delete', 'AuthUserController@delete')->name('auth_users.delete');

                // auth_menus
                Route::resource('auth/menus', 'AuthMenuController', ['except' => ['create', 'show']])->names('auth_menus');
                Route::put('auth/menus/{menu}/restore', 'AuthMenuController@restore')->name('auth_menus.restore');
                Route::delete('auth/menus/{menu}/delete', 'AuthMenuController@delete')->name('auth_menus.delete');
            });
        });
    }
}