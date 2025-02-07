<?php

namespace Elegance\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Assets
{
    /**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $style = [];

    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $js = [];

    /**
     * @var array
     */
    public static $html = [];

    /**
     * @var array
     */
    public static $requires = ['admin'];

    /**
     * @var array
     */
    public static $requireAlias = [
        'icheck' => 'css!css/icheck-bootstrap/icheck-bootstrap.min',
    ];

    /**
     * @var array
     */
    public static $packages = [];

    /**
     * @var array
     */
    public static $assets = [
        'admin' => [
            'js' => [
                'js/app'
            ],
            'css' => [
                'css/fontawesome-free/css/all.min',
                'css/app',
            ],
            'deps' => [
                'bootstrap',
                'adminlte',
                'pjax',
            ],
            'export' => '$',
        ],
        'jquery' => [
            'js' => [
                'js/jquery/jquery.min'
            ]
        ],
        'pjax' => [
            'js' => [
                'js/jquery-pjax/jquery.pjax'
            ],
            'deps' => [
                'jquery',
            ],
        ],
        'NProgress' => [
            'js' => [
                'js/nprogress/nprogress'
            ],
            'css' => [
                'css/nprogress/nprogress'
            ],
        ],
        'bootstrap' => [
            'js' => [
                'js/bootstrap/bootstrap.bundle.min'
            ],
            'deps' => [
                'jquery',
            ],
        ],
        'adminlte' => [
            'js' => [
                'js/admin-lte/adminlte.min'
            ],
            'css' => [
                'css/admin-lte/adminlte.min'
            ],
            'deps' => [
                'bootstrap',
            ],
        ],
        'sweetalert2' => [
            'js' => [
                'js/sweetalert2/sweetalert2.min'
            ],
            'css' => [
                'css/sweetalert2/sweetalert2.min'
            ],
        ],
        'initialize' => [
            'js' => [
                'js/jquery.initialize/jquery.initialize.min'
            ],
            'deps' => [
                'jquery'
            ],
        ],
        'echarts' => [
            'js' => [
                'js/echarts/echarts.min'
            ],
            'deps' => [
                'jquery'
            ],
            'export' => 'echarts',
        ],
        'nestable' => [
            'js' => [
                'js/nestable/jquery.nestable'
            ],
            'css' => [
                'css/nestable/nestable'
            ],
            'deps' => [
                'jquery',
            ],
        ],
        'iconpicker' => [
            'js' => [
                'js/bootstrap-icon-picker/bootstrap-iconpicker.bundle.min'
            ],
            'css' => [
                'css/bootstrap-icon-picker/bootstrap-iconpicker.min'
            ],
            'deps' => [
                'jquery',
            ],
        ],
//        'colorpicker'             => [
//            'deps' => 'jquery',
//            'css' => 'bootstrap-colorpicker/css/bootstrap-colorpicker.min',
//            'js'  => 'bootstrap-colorpicker/js/bootstrap-colorpicker.min',
//        ],
        'sortable' => [
            'js' => [
                'js/bootstrap-fileinput/plugins/sortable.min'
            ],
            'export' => 'Sortable',
        ],
        'fileinput-base' => [
            'js' => [
                'js/bootstrap-fileinput/fileinput.min'
            ],
        ],
        'fileinput' => [
            'js' => [
                'js/bootstrap-fileinput/themes/fas/theme.min'
            ],
            'css' => [
                'css/bootstrap-fileinput/fileinput.min'
            ],
            'deps' => [
                'fileinput-base'
            ],
        ],
        'moment' => [
            'js' => [
                'js/moment/moment-with-locales.min'
            ],
        ],
        'datetimepicker' => [
            'js' => [
                'js/bootstrap4-datetimepicker/bootstrap-datetimepicker.min'
            ],
            'css' => [
                'css/bootstrap4-datetimepicker/bootstrap-datetimepicker.min'
            ],
            'deps' => [
                'moment'
            ],
        ],
        'select2' => [
            'js' => [
                'js/select2/select2.full.min'
            ],
            'css' => [
                'css/select2/select2.min',
                'css/select2-bootstrap4-theme/select2-bootstrap4.min',
            ],
        ],
        'bootstrap-input-spinner' => [
            'js' => [
                'js/bootstrap-input-spinner/bootstrap-input-spinner'
            ],
            'deps' => [
                'jquery'
            ],
        ],
        'toggle' => [
            'js' => [
                'js/bootstrap4-toggle/bootstrap4-toggle.min'
            ],
            'css' => [
                'css/bootstrap4-toggle/bootstrap4-toggle.min'
            ],
        ],
        'inputmask' => [
            'js' => [
                'js/inputmask/jquery.inputmask.bundle.min'
            ],
            'deps' => [
                'jquery'
            ],
        ],
        'duallistbox' => [
            'js' => [
                'js/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min'
            ],
            'css' => [
                'css/bootstrap4-duallistbox/bootstrap-duallistbox.min'
            ],
        ],
        'rangeSlider' => [
            'js' => [
                'js/ion-rangeslider/ion.rangeSlider.min'
            ],
            'css' => [
                'css/ion-rangeslider/ion.rangeSlider.min'
            ],
        ],
        'wangEditor' => [
            'js' => [
                'https://cdn.jsdelivr.net/npm/wangeditor@4.2.0/dist/wangEditor.min'
            ],
            'export' => 'wangEditor',
        ],
        'treejs' => [
            'js' => [
                'js/treejs/tree.min'
            ],
            'export' => 'Tree',
        ],
    ];

    /**
     * @return array
     */
    public static function getRequires()
    {
        foreach (static::$css as $css) {
            static::$requires[] = 'css!' . $css;
        }

        foreach (static::$js as $js) {
            static::$requires[] = $js;
        }

        return array_unique(static::$requires);
    }

    /**
     * @param $module
     */
    public static function require($module)
    {
        if (is_array($module)) {
            foreach ($module as $item) {
                static::require($item);
            }

            return;
        }

        if (Str::contains($module, ',')) {
            return static::require(explode(',', $module));
        }

        if (isset(static::$requireAlias[$module])) {
            $module = static::$requireAlias[$module];
        }

        static::$requires = array_unique(array_merge(static::$requires, Arr::wrap($module)));
    }

    /**
     * @param array $assets
     */
    public static function setExport($module, $export)
    {
        Arr::get(static::$assets, "{$module}.export", $export);
    }

    /**
     * @return array
     */
    public static function getExports()
    {
        return array_map(function ($module) {
            return Arr::get(static::$assets, "{$module}.export", '_');
        }, static::$requires);
    }

    /**
     * @param string $module
     * @param array $assets
     */
    public static function define($module, $assets)
    {
        array_walk_recursive($assets, function (&$asset) {
            $asset = preg_replace('/(\.js|\.css)$/', '', $asset);
        });

        static::$assets[$module] = $assets;
    }

    /**
     * @param string $module
     * @param string|array $requires
     */
    public static function alias($module, $requires)
    {
        static::$requireAlias[$module] = $requires;
    }

    /**
     * @param array $package
     */
    public static function package($package)
    {
        static::$packages[] = $package;
    }

    /**
     * @return array
     */
    public static function config()
    {
        $config = [
            'baseUrl' => admin_asset('/vendor/laravel-admin/'),
            'map' => [
                '*' => [
                    'css' => 'css'
                ],
            ],
            'packages' => static::$packages,
        ];

        foreach (static::$assets as $module => $assets) {
            if (Arr::has($assets, 'js')) {
                Arr::set($config, "paths.{$module}", (array)$assets['js']);
            }

            if (Arr::has($assets, 'css')) {
                $deps = Arr::get($config, "shim.{$module}.deps", []);
                Arr::set($config, "shim.{$module}.deps", array_merge($deps, array_map(function ($css) {
                    return "css!{$css}";
                }, (array)$assets['css'])));
            }

            if (Arr::has($assets, 'deps')) {
                $deps = Arr::get($config, "shim.{$module}.deps", []);
                Arr::set($config, "shim.{$module}.deps", array_merge($deps, (array)$assets['deps']));
            }
        }

        return $config;
    }
}
