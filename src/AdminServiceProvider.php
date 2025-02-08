<?php

namespace Elegance\Admin;

use Elegance\Admin\Http\Middleware;
use Elegance\Admin\Layout\Content;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        Console\AdminCommand::class,
        Console\MakeCommand::class,
        Console\ControllerCommand::class,
        Console\MenuCommand::class,
        Console\InstallCommand::class,
        Console\PublishCommand::class,
        Console\UninstallCommand::class,
        Console\ImportCommand::class,
        Console\CreateUserCommand::class,
        Console\ResetPasswordCommand::class,
        Console\ExtendCommand::class,
        Console\ExportSeedCommand::class,
        Console\MinifyCommand::class,
        Console\FormCommand::class,
        Console\ActionCommand::class,
        Console\GenerateMenuCommand::class,
        Console\ConfigCommand::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin.pjax' => Middleware\Pjax::class,
        'admin.bootstrap' => Middleware\Bootstrap::class,
        'admin.authorization' => Middleware\Authorization::class,
        'admin.log' => Middleware\OperationLog::class,
//        'admin.sul' => Middleware\SingleUserLogin::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.pjax',
            'admin.bootstrap',
            'admin.authorization',
            'admin.log',
//            'admin.sul',
        ],
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');

        $this->ensureHttps();

        if (file_exists($routes = admin_directory('routes.php'))) {
            $this->loadRoutesFrom($routes);
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        }

        $this->registerPublishing();

        $this->compatibleBlade();

        $this->registerBladeDirective();
    }

    protected function registerBladeDirective()
    {
        Blade::directive('el', function ($name) {
            return <<<PHP
<?php
if (!isset(\$__id)) {
    \$__id = uniqid();
    echo "class='{\$__id} {$name}'";
} else {
    echo "$('.{\$__id}')";
}
?>
PHP;
        });

        Blade::directive('id', function () {
            return <<<'PHP'
<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>
PHP;
        });

        Blade::directive('color', function () {
            $color = config('admin.theme.color');

            return <<<PHP
<?php echo "{$color}";?>
PHP;
        });

        Blade::directive('script', function () {
            return <<<'PHP'
<?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>
PHP;
        });
    }

    /**
     * Force to set https scheme if https enabled.
     *
     * @return void
     */
    protected function ensureHttps()
    {
        if (config('admin.https')) {
            url()->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()], 'laravel-admin-config');
            $this->publishes([__DIR__ . '/../resources/lang' => lang_path()], 'laravel-admin-lang');
            $this->publishes([__DIR__ . '/../database' => database_path()], 'laravel-admin-database');
            $this->publishes([__DIR__ . '/../resources/assets' => public_path('vendor/laravel-admin')], 'laravel-admin-assets');
        }
    }

    /**
     * Remove default feature of double encoding enable in laravel 5.6 or later.
     *
     * @return void
     */
    protected function compatibleBlade()
    {
        $reflectionClass = new \ReflectionClass('\Illuminate\View\Compilers\BladeCompiler');

        if ($reflectionClass->hasMethod('withoutDoubleEncoding')) {
            Blade::withoutDoubleEncoding();
        }
    }

    /**
     * Extends laravel router.
     */
    protected function macroRouter()
    {
        Router::macro('content', function ($uri, $content, $options = []) {
            return $this->match(['GET', 'HEAD'], $uri, function (Content $layout) use ($content, $options) {
                return $layout
                    ->title(Arr::get($options, 'title', ' '))
                    ->description(Arr::get($options, 'desc', ' '))
                    ->body($content);
            });
        });

        Router::macro('adminView', function ($uri, $component, $data = [], $options = []) {
            return $this->match(['GET', 'HEAD'], $uri, function (Content $layout) use ($component, $data, $options) {
                return $layout
                    ->title(Arr::get($options, 'title', ' '))
                    ->description(Arr::get($options, 'desc', ' '))
                    ->view($component, $data);
            });
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRouteMiddleware();

        $this->commands($this->commands);

        $this->macroRouter();

        $this->app->singleton('admin', function ($app) {
            return new Admin();
        });
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        if (config('admin.single_device_login')) {
            array_push($this->middlewareGroups['admin'], 'admin.sul');
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
