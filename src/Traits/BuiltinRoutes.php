<?php

namespace Elegant\Utils\Traits;

use Elegant\Utils\Http\Controllers\AdministratorController;
use Elegant\Utils\Http\Controllers\AuthController;
use Elegant\Utils\Http\Controllers\MenuController;
use Elegant\Utils\Http\Controllers\MenuGroupController;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

trait BuiltinRoutes
{
    /**
     * Register the laravel-admin builtin routes.
     *
     * @return void
     */
    public function routes()
    {
        app('router')->group([
            'middleware' => config('elegant-utils.admin.route.middleware'),
            'as' => config('elegant-utils.admin.route.as'),
        ], function ($router) {
            /* @var Router $router */
            $administratorController = config('elegant-utils.admin.database,administrator_controller', AdministratorController::class);
            $router->resource('administrators', $administratorController)->names('administrators');
            $router->put('administrators/{administrator}/restore', $administratorController.'@restore')->name('administrators.restore');
            $router->delete('administrators/{administrator}/delete', $administratorController.'@delete')->name('administrators.delete');

            $menuController = config('elegant-utils.admin.database,menus_controller', MenuController::class);
            $router->resource('menus', $menuController, ['except' => ['create', 'show']])->names('menus');
            $router->put('menus/{menu}/restore', $menuController.'@restore')->name('menus.restore');
            $router->delete('menus/{menu}/delete', $menuController.'@delete')->name('menus.delete');
        });

        app('router')->group([
            'middleware' => config('elegant-utils.admin.route.middleware')
        ], function ($router) {
            /* @var Router $router */
            $authController = config('elegant-utils.admin.auth.controller', AuthController::class);
            $router->get('logout', $authController.'@getLogout')->name('logout');
            $router->get('setting', $authController.'@getSetting')->name('setting');
            $router->put('setting', $authController.'@putSetting')->name('setting_put');

            $router->namespace('\Elegant\Utils\Http\Controllers')->group(function ($router) {
                $router->post('_handle_form_', 'HandleController@handleForm')->name('handle_form');
                $router->post('_handle_action_', 'HandleController@handleAction')->name('handle_action');
                $router->get('_handle_selectable_', 'HandleController@handleSelectable')->name('handle_selectable');
                $router->get('_handle_renderable_', 'HandleController@handleRenderable')->name('handle_renderable');
                // requirejs配置
                $router->get('_require_config', 'PagesController@requireConfig')->name('require-config');

                $router->fallback('PagesController@error404')->name('error404');
            });
        });

        app('router')->group([
            'middleware' => array_filter(config('elegant-utils.admin.route.middleware'), function ($value) {
                return $value !== 'auth';
            })
        ], function ($router) {
            $authController = config('elegant-utils.admin.auth.controller', AuthController::class);

            /* @var Router $router */
            $router->get('login', $authController.'@getLogin')->name('login');
            $router->post('login', $authController.'@postLogin')->name('login_post');
        });
    }
}
