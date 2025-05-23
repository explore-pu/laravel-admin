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

        'right' => '<div class="float-right d-none d-sm-block"><strong>Env</strong> ' . env('APP_ENV') . '</div>',
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

        // The name of the route that needs to be excluded during authentication
        'excepts' => [
            'logout',
            'setting',
            'setting.update',
            'handle_form',
            'handle_action',
            'handle_selectable',
            'handle_renderable',
            'require_config',
            'error404',
        ]
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
        // If necessary, you can extend this controller and rewrite
        'controller' => Elegance\Admin\Http\Controllers\AuthController::class,

        // Login username field
        'username' => 'email',

        // Login password field
        'password' => 'password',

        // Add "remember me" to login form
        'remember' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Single device login
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
        'user_table' => 'users',
        // The user model is consistent with the AUTH model
        'user_model' => App\Models\User::class,
        // If necessary, you can extend this controller and rewrite
        'user_controller' => Elegance\Admin\Http\Controllers\UserController::class,

        // roles tables and model and controller.
        'role_table' => 'roles',
        // If necessary, you can extend this model and rewrite
        'role_model' => Elegance\Admin\Models\Role::class,
        // If necessary, you can extend this controller and rewrite
        'role_controller' => Elegance\Admin\Http\Controllers\RoleController::class,

        // permissions tables and model.
        'permission_table' => 'permissions',
        // If necessary, you can extend this model and rewrite
        'permission_model' => Elegance\Admin\Models\Permission::class,
        // If necessary, you can extend this controller and rewrite
        'permission_controller' => Elegance\Admin\Http\Controllers\PermissionController::class,

        // permissions tables and model.
        'log_table' => 'logs',
        // If necessary, you can extend this model and rewrite
        'log_model' => Elegance\Admin\Models\Log::class,
        // If necessary, you can extend this controller and rewrite
        'log_controller' => Elegance\Admin\Http\Controllers\LogController::class,

        // Limit the maximum number of administrator roles that can be selected, default is 0, 0 means no limit
        'user_maximum_roles' => 0,

        // User and role association information
        'user_role_relational' => [
            'table' => 'user_roles',
            'user_id' => 'user_id',
            'role_id' => 'role_id',
        ],

        // User and permissions association information
        'user_permission_relational' => [
            'table' => 'user_permissions',
            'user_id' => 'user_id',
            'permission_id' => 'permission_id',
        ],

        // Role and permissions association information
        'role_permission_relational' => [
            'table' => 'role_permissions',
            'role_id' => 'role_id',
            'permission_id' => 'permission_id',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Enable authorization
    |--------------------------------------------------------------------------
    |
    | Whether enable authorization for admin route.
    */
    'enable_authorization' => true,

    /*
    |--------------------------------------------------------------------------
    | data power
    |--------------------------------------------------------------------------
    |
    | Configure the power of the role to obtain data
    | e.g: ['all', 'self_team']
    */
    'data_powers' => [],

    /*
    |--------------------------------------------------------------------------
    | Operation_logs
    |--------------------------------------------------------------------------
    |
    | Log configuration items
    |
    */
    'operation_logs' => [
        // switch
        'enable' => true,
        // Only logging allowed methods in the list
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],
        // Do not log routes containing
        'excepts' => [
            "require_config",
            "logs.index",
            "logs.destroy",
            "error404",
        ],
        // Secrecy the input fields
        'secrecy_keys' => [
            'password',
            'password_confirmation',
        ]
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
        | Default color for a and card and form and buttons.
        |--------------------------------------------------------------------------
        |
        | Available options: primary secondary info warning danger
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
    | Alert message that will be displayed on top of the page.
    |--------------------------------------------------------------------------
    */
    'top_alert' => '',

    /*
    |--------------------------------------------------------------------------
    | The global Table action display class.
    |--------------------------------------------------------------------------
    */
    'table_action_class' => Elegance\Admin\Table\Displayers\DropdownActions::class,

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
