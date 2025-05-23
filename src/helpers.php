<?php

use Elegance\Admin\Admin;
use Illuminate\Support\MessageBag;

if (!function_exists('admin_directory')) {

    /**
     * Get admin path.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_directory($path = '')
    {
        return ucfirst(config('admin.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('admin_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed  $parameters
     * @param bool   $secure
     *
     * @return string
     */
    function admin_url($path = '', $parameters = [], $secure = null)
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: (config('admin.https'));

        return url(admin_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_base_path($path = '')
    {
        $prefix = '/'.trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix.'/'.$path;
    }
}

if (!function_exists('admin_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     */
    function admin_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());

        session()->flash('toastr', $toastr);
    }
}

if (!function_exists('admin_success')) {

    /**
     * Flash a success message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_success($title, $message = '')
    {
        admin_info($title, $message, 'success');
    }
}

if (!function_exists('admin_error')) {

    /**
     * Flash a error message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_error($title, $message = '')
    {
        admin_info($title, $message, 'error');
    }
}

if (!function_exists('admin_warning')) {

    /**
     * Flash a warning message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_warning($title, $message = '')
    {
        admin_info($title, $message, 'warning');
    }
}

if (!function_exists('admin_info')) {

    /**
     * Flash a message bag to session.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     */
    function admin_info($title, $message = '', $type = 'info')
    {
        $message = new MessageBag(get_defined_vars());

        session()->flash($type, $message);
    }
}

if (!function_exists('admin_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function admin_asset($path)
    {
        return (config('admin.https')) ? secure_asset($path) : asset($path);
    }
}

if (!function_exists('admin_assets_require')) {

    /**
     * @param $path
     *
     * @return string
     */
    function admin_assets_require($assets)
    {
        \Elegance\Admin\Assets::require($assets);
    }
}

if (!function_exists('admin_color')) {

    /**
     * @param string $prefix
     *
     * @return string
     */
    function admin_color($tpl = '')
    {
        if ($tpl) {
            return str_replace('%s', config('admin.theme.color'), $tpl);
        }

        return config('admin.theme.color');
    }
}

if (!function_exists('admin_trans')) {

    /**
     * Translate the given message.
     *
     * @param string $key
     * @param array  $replace
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function admin_trans($key = null, $replace = [], $locale = null)
    {
        $line = __($key, $replace, $locale);

        if (!is_string($line)) {
            return $key;
        }

        return $line;
    }
}

if (!function_exists('array_delete')) {

    /**
     * Delete from array by value.
     *
     * @param array $array
     * @param mixed $value
     */
    function array_delete(&$array, $value)
    {
        $value = \Illuminate\Support\Arr::wrap($value);

        foreach ($array as $index => $item) {
            if (in_array($item, $value)) {
                unset($array[$index]);
            }
        }
    }
}

if (!function_exists('class_uses_deep')) {

    /**
     * To get ALL traits including those used by parent classes and other traits.
     *
     * @param $class
     * @param bool $autoload
     *
     * @return array
     */
    function class_uses_deep($class, $autoload = true)
    {
        $traits = [];

        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while ($class = get_parent_class($class));

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }

        return array_unique($traits);
    }
}

if (!function_exists('admin_dump')) {

    /**
     * @param $var
     *
     * @return string
     */
    function admin_dump($var)
    {
        ob_start();

        dump(...func_get_args());

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}

if (!function_exists('file_size')) {

    /**
     * Convert file size to a human readable format like `100mb`.
     *
     * @param int $bytes
     *
     * @return string
     *
     * @see https://stackoverflow.com/a/5501447/9443583
     */
    function file_size($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2).' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2).' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2).' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes.' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes.' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

if (!function_exists('prepare_options')) {

    /**
     * @param array $options
     *
     * @return array
     */
    function prepare_options(array $options)
    {
        $original = [];
        $toReplace = [];

        foreach ($options as $key => &$value) {
            if (is_array($value)) {
                $subArray = prepare_options($value);
                $value = $subArray['options'];
                $original = array_merge($original, $subArray['original']);
                $toReplace = array_merge($toReplace, $subArray['toReplace']);
            } elseif (strpos($value, 'function(') === 0) {
                $original[] = $value;
                $value = "%{$key}%";
                $toReplace[] = "\"{$value}\"";
            }
        }

        return compact('original', 'toReplace', 'options');
    }
}

if (!function_exists('json_encode_options')) {

    /**
     * @param array $options
     *
     * @return string
     *
     * @see http://web.archive.org/web/20080828165256/http://solutoire.com/2008/06/12/sending-javascript-functions-over-json/
     */
    function json_encode_options(array $options)
    {
        $data = prepare_options($options);

        $json = json_encode($data['options']);

        return str_replace($data['toReplace'], $data['original'], $json);
    }
}

if (!function_exists('admin_attrs')) {
    function admin_attrs(array $attributes = [])
    {
        $str = [];

        foreach ($attributes as $name => $value) {
            $str[] = "$name=\"$value\"";
        }

        return implode(' ', $str);
    }
}

function admin_login_page_backgroud()
{
    if (config('admin.login_background_image')) {
        $image = config('admin.login_background_image');
    } else {
        $hour = date('H');

        $index = 1;

        if ($hour > 8 && $hour < 18) {
            $index = 2;
        } elseif ($hour >= 18 && $hour < 20) {
            $index = 3;
        } elseif ($hour >= 20 || $hour <= 8) {
            $index = 4;
        }

        $image = "/vendor/laravel-admin/img/login-bg{$index}.svg";
    }

    return 'style="background: url(' . $image . ') no-repeat;background-size: cover;"';
}

if (!function_exists('admin_view')) {

    /**
     * @param string $view
     * @param array  $data
     *
     * @throws Throwable
     *
     * @return string
     */
    function admin_view($view, $data = [])
    {
        return Admin::view($view, $data);
    }
}

if (!function_exists('admin_route')) {
    /**
     * @param $name
     * @param array $parameters
     * @param bool $absolute
     * @return mixed
     */
    function admin_route($name, $parameters = [], $absolute = true)
    {
        $name = config('admin.route.as', '') . $name;

        return app('url')->route($name, $parameters, $absolute);
    }
}

if (!function_exists('build_tree')) {
    /**
     * @param array $items
     * @param string|int $parent_id
     * @param string $parent_field
     * @return array
     */
    function build_tree(array $items, string|int $parent_id = 0, string $parent_field = 'parent_id'): array
    {
        $branch = [];

        foreach ($items as $item) {
            if ($item[$parent_field] == $parent_id) {
                $children = build_tree($items, $item['id'], $parent_field);

                if ($children) {
                    $item['children'] = $children;
                }

                $branch[] = $item;
            }
        }

        return $branch;
    }
}
