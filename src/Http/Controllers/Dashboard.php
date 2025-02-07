<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Facades\Admin;
use Elegance\Admin\Widgets\Echarts;
use Illuminate\Support\Arr;

class Dashboard
{
    /**
     * @return Echarts
     */
    public static function echartLine()
    {
        $echart = new Echarts('line-demo');

        $echart->scripts(self::lineScripts());

        return $echart;
    }

    /**
     * @return Echarts
     */
    public static function echartBar()
    {
        $echart = new Echarts('bar-demo');

        $echart->scripts(self::barScripts());

        return $echart;
    }

    /**
     * @return string
     */
    public static function title()
    {
        return Admin::view('admin::dashboard.title');
    }

    /**
     * @return string
     */
    public static function environment()
    {
        $envs = [
            ['name' => 'PHP version',       'value' => 'PHP/'.PHP_VERSION],
            ['name' => 'Laravel version',   'value' => app()->version()],
            ['name' => 'CGI',               'value' => php_sapi_name()],
            ['name' => 'Uname',             'value' => php_uname()],
            ['name' => 'Server',            'value' => Arr::get($_SERVER, 'SERVER_SOFTWARE')],

            ['name' => 'Cache driver',      'value' => config('cache.default')],
            ['name' => 'Session driver',    'value' => config('session.driver')],
            ['name' => 'Queue driver',      'value' => config('queue.default')],

            ['name' => 'Timezone',          'value' => config('app.timezone')],
            ['name' => 'Locale',            'value' => config('app.locale')],
            ['name' => 'Env',               'value' => config('app.env')],
            ['name' => 'URL',               'value' => config('app.url')],
        ];

        return Admin::view('admin::dashboard.environment', compact('envs'));
    }

    /**
     * @return string
     */
    public static function utils()
    {
        $utils = [
//            'logs' => [
//                'name' => 'laravel-admin-utils/operation-logs',
//                'link' => 'https://github.com/laravel-admin-utils/operation-logs',
//                'icon' => 'fas fa-history',
//            ],
//            'helpers' => [
//                'name' => 'laravel-admin-ext/helpers',
//                'link' => 'https://github.com/laravel-admin-utils/helpers',
//                'icon' => 'fas fa-cogs',
//            ],
//            'log-viewer' => [
//                'name' => 'laravel-admin-ext/log-viewer',
//                'link' => 'https://github.com/laravel-admin-utils/log-viewer',
//                'icon' => 'fas fa-database',
//            ],
//            'backup' => [
//                'name' => 'laravel-admin-ext/backup',
//                'link' => 'https://github.com/laravel-admin-utils/backup',
//                'icon' => 'fas fa-copy',
//            ],
//            'config' => [
//                'name' => 'laravel-admin-ext/config',
//                'link' => 'https://github.com/laravel-admin-utils/config',
//                'icon' => 'fas fa-toggle-on',
//            ],
//            'api-tester' => [
//                'name' => 'laravel-admin-ext/api-tester',
//                'link' => 'https://github.com/laravel-admin-utils/api-tester',
//                'icon' => 'fas fa-mouse',
//            ],
//            'media-manager' => [
//                'name' => 'laravel-admin-ext/media-manager',
//                'link' => 'https://github.com/laravel-admin-utils/media-manager',
//                'icon' => 'fas fa-file',
//            ],
//            'scheduling' => [
//                'name' => 'laravel-admin-ext/scheduling',
//                'link' => 'https://github.com/laravel-admin-utils/scheduling',
//                'icon' => 'fas fa-calendar-alt',
//            ],
//            'reporter' => [
//                'name' => 'laravel-admin-ext/reporter',
//                'link' => 'https://github.com/laravel-admin-utils/reporter',
//                'icon' => 'fas fa-bug',
//            ],
//            'redis-manager' => [
//                'name' => 'laravel-admin-ext/redis-manager',
//                'link' => 'https://github.com/laravel-admin-utils/redis-manager',
//                'icon' => 'fas fa-flask',
//            ],
        ];

        foreach ($utils as &$util) {
            $name = explode('/', $util['name']);
            $util['installed'] = array_key_exists(end($name), Admin::getUtils());
        }

        return Admin::view('admin::dashboard.utils', compact('utils'));
    }

    /**
     * @return string
     */
    public static function dependencies()
    {
        $json = file_get_contents(base_path('composer.json'));

        $dependencies = json_decode($json, true)['require'];

        return Admin::view('admin::dashboard.dependencies', compact('dependencies'));
    }

    /**
     * @return string
     */
    protected static function lineScripts()
    {
        return <<<SCRIPT

const option = {
  xAxis: {
    type: 'category',
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [150, 230, 224, 218, 135, 147, 260],
      type: 'line'
    }
  ]
};

myChart.setOption(option);
SCRIPT;
    }

    /**
     * @return string
     */
    protected static function barScripts()
    {
        return <<<SCRIPT

const option = {
  xAxis: {
    type: 'category',
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [120, 200, 150, 80, 70, 110, 130],
      type: 'bar'
    }
  ]
};

myChart.setOption(option);
SCRIPT;
    }
}
