<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The name of admin application
    |--------------------------------------------------------------------------
    |
    | This value is the name of admin application, This setting is displayed on the
    | login page.
    |
    */
    'name' => 'Laravel-Admin',

    /*
    |--------------------------------------------------------------------------
    | Logo setting of admin application
    |--------------------------------------------------------------------------
    |
    */
    'logo' => [

        'image' => '/vendor/laravel-admin/img/AdminLTELogo.png',

        'text' => '<span class="font-weight-bolder">Laravel-Admin</span>',
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer setting of admin application
    |--------------------------------------------------------------------------
    |
    */
    'footer' => [
        'left' => '<strong>Powered by <a href="https://github.com/explore-pu/laravel-admin" target="_blank">laravel-admin</a></strong>',

        'right' => '<div class="float-right d-none d-sm-block"><strong>Env</strong> ' . config('app.env') . '</div>',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin bootstrap setting
    |--------------------------------------------------------------------------
    |
    | This value is the path of laravel-admin bootstrap file.
    |
    */
    'bootstrap' => app_path('Admin/bootstrap.php'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [
        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'auth', 'admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan admin::install` to take effect.
    |
    */
    'directory' => app_path('Admin'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin html title
    |--------------------------------------------------------------------------
    |
    | Html title for all pages.
    |
    */
    'title' => env('APP_NAME', 'Admin'),

    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | If your page is going to be accessed via https, set it to `true`.
    |
    */
    'https' => env('ADMIN_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    | You can specify a controller for `login` `logout` and other auth routes.
    |
    */
    'auth' => [
        'providers' => [
            'users' => [
                'model'  => env('AUTH_MODEL', App\Models\AuthUser::class),
            ],
        ],

        // Add "remember me" to login form
        'remember' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Single device login / 单设备登录
    |--------------------------------------------------------------------------
    |
    | Invalidating and "logging out" a user's sessions that are active on other
    | devices without invalidating the session on their current device.
    |
    */
    'single_device_login' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin upload setting
    |--------------------------------------------------------------------------
    |
    | File system configuration for form upload files and images, including
    | disk and upload path.
    |
    */
    'upload' => [

        // Disk in `config/filesystem.php`.
        'disk' => 'public',

        // Image and file upload path under the disk above.
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for laravel-admin builtin model & tables.
    |
    */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // authenticate users tables and model.
        'user_table' => 'auth_users',
        'user_model' => App\Models\AuthUser::class,
        'user_controller' => App\Admin\Controllers\AuthUserController::class,

        // authenticate menu table and model.
        'menu_table' => 'auth_menus',
        'menu_model' => App\Models\AuthMenu::class,
        'menu_controller' => App\Admin\Controllers\AuthMenuController::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | User default avatar
    |--------------------------------------------------------------------------
    |
    | Set a default avatar for newly created users.
    |
    */
    'default_avatar' => '/vendor/laravel-admin/img/user2-160x160.jpg',

    /*
    |--------------------------------------------------------------------------
    | Application theme
    |--------------------------------------------------------------------------
    |
    | @see https://adminlte.io/docs/3.0/layout.html
    |
    */
    'theme' => [
        /*
        |--------------------------------------------------------------------------
        | Available layout options.
        |--------------------------------------------------------------------------
        | Fixed Sidebar: use the class `.layout-fixed` to get a fixed sidebar.
        | Fixed Navbar: use the class `.layout-navbar-fixed` to get a fixed navbar.
        | Fixed Footer: use the class `.layout-footer-fixed` to get a fixed footer.
        | Collapsed Sidebar: use the class `.sidebar-collapse` to have a collapsed sidebar upon loading.
        | Boxed Layout: use the class `.layout-boxed` to get a boxed layout that stretches only to 1250px.
        | Top Navigation: use the class `.layout-top-nav` to remove the sidebar and have your links at the top navbar.
        |
        */
        'layout' => ['sidebar-mini', 'layout-navbar-fixed', 'layout-fixed', 'text-sm'],

        /*
        |--------------------------------------------------------------------------
        | Default color for a, card, form and buttons.
        |--------------------------------------------------------------------------
        |
        | Available options: primary secondary secondary info warning danger
        */
        'color' => 'info',
    ],

    /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | This value is used to set the background image of login page.
    |
    */
    'login_background_image' => '',

    /*
    |--------------------------------------------------------------------------
    | Show version at footer
    |--------------------------------------------------------------------------
    |
    | Whether to display the version number of laravel-admin at the footer of
    | each page
    |
    */
    'show_version' => true,

    /*
    |--------------------------------------------------------------------------
    | Show environment at footer
    |--------------------------------------------------------------------------
    |
    | Whether to display the environment at the footer of each page
    |
    */
    'show_environment' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable default breadcrumb
    |--------------------------------------------------------------------------
    |
    | Whether enable default breadcrumb for every page content.
    */
    'enable_default_breadcrumb' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable/Disable assets minify
    |--------------------------------------------------------------------------
    */
    'minify_assets' => [

        // Assets will not be minified.
        'excepts' => [

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Alert message that will displayed on top of the page.
    |--------------------------------------------------------------------------
    */
    'top_alert' => '',

    /*
    |--------------------------------------------------------------------------
    | The global Table action display class.
    |--------------------------------------------------------------------------
    */
    'table_action_class' => \Elegant\Utils\Table\Displayers\DropdownActions::class,

    /*
    |--------------------------------------------------------------------------
    | Extension Directory
    |--------------------------------------------------------------------------
    |
    | When you use command `php artisan admin:extend` to generate extensions,
    | the extension files will be generated in this directory.
    */
    'extension_dir' => app_path('Admin/Extensions'),

    /*
    |--------------------------------------------------------------------------
    | Settings for extensions.
    |--------------------------------------------------------------------------
    |
    | You can find all available extensions here
    | https://github.com/laravel-admin-extensions.
    |
    */
    'extensions' => [

    ],
];
