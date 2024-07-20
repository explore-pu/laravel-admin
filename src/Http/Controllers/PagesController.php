<?php

namespace Elegant\Admin\Http\Controllers;

use Elegant\Admin\Assets;
use Elegant\Admin\Facades\Admin;
use Elegant\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class PagesController extends Controller
{
    public function error404(Content $content)
    {
        return $content
            ->title('Error')
            ->description('404')
            ->view('admin::pages.404');
    }

    public function requireConfig()
    {
        if ($user = Auth::user()) {
            $user = Arr::only($user->toArray(), ['id', 'username', 'email', 'name', 'avatar']);
        }

        return response(view('admin::partials.config', [
            'requirejs' => Assets::config(),
            'user'      => $user ?: [],
            'trans'     => Lang::get('admin'),
        ]))->header('Content-Type', 'application/javascript');
    }
}