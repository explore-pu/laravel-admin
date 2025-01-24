<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Elegance\Admin\Http\Controllers',
    'middleware' => config('admin.route.middleware'),
], function () {
    Route::post('_handle_form_', 'HandleController@handleForm')->name('handle_form');
    Route::post('_handle_action_', 'HandleController@handleAction')->name('handle_action');
    Route::get('_handle_selectable_', 'HandleController@handleSelectable')->name('handle_selectable');
    Route::get('_handle_renderable_', 'HandleController@handleRenderable')->name('handle_renderable');
    // requirejs配置
    Route::get('_require_config', 'PagesController@requireConfig')->name('require_config');

    Route::fallback('PagesController@error404')->name('error404');
});
