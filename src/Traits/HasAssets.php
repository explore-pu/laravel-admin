<?php

namespace Elegance\Admin\Traits;

use DOMDocument;
use DOMElement;
use Elegance\Admin\Assets;

trait HasAssets
{
    /**
     * Add css or get all css.
     *
     * @param string|array $css
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function css($css)
    {
        Assets::$css = array_merge(Assets::$css, (array) $css);
    }

    /**
     * Add js or get all js.
     *
     * @param string|array $js
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function js($js)
    {
        Assets::$js = array_merge(Assets::$js, (array) $js);
    }

    /**
     * @param string $script
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function script($script = '', $deferred = false)
    {
        if (!empty($script)) {
            return Assets::$script = array_merge(Assets::$script, (array) $script);
        }

        $script = array_unique(Assets::$script);
        $requires = Assets::getRequires();
        $exports = Assets::getExports();

        return view('admin::partials.script', compact('script', 'requires', 'exports'));
    }

    /**
     * @param string $style
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function style($style = '')
    {
        if (!empty($style)) {
            return Assets::$style = array_merge(Assets::$style, (array) $style);
        }

        $style = collect(Assets::$style)
            ->unique()
            ->map(function ($line) {
                return preg_replace('/\s+/', ' ', $line);
            });

        return view('admin::partials.style', compact('style'));
    }

    /**
     * @param string $html
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function html($html = '')
    {
        if (!empty($html)) {
            return Assets::$html = array_merge(Assets::$html, (array) $html);
        }

        return view('admin::partials.html', ['html' => array_unique(Assets::$html)]);
    }

    /**
     * @param $component
     */
    public static function component($component, $data = [])
    {
        $string = view($component, $data)->render();

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$string);
        libxml_use_internal_errors(false);

        if ($head = $dom->getElementsByTagName('head')->item(0)) {
            foreach ($head->childNodes as $child) {
                if ($child instanceof DOMElement) {
                    if ($child->tagName == 'style' && !empty($child->nodeValue)) {
                        static::style($child->nodeValue);
                        continue;
                    }

                    if ($child->tagName == 'link' && $child->hasAttribute('href')) {
                        static::css($child->getAttribute('href'));
                    }

                    if ($child->tagName == 'script') {
                        if ($child->hasAttribute('src')) {
                            static::js($child->getAttribute('src'));
                        } else {
                            static::script(';(function () {'.$child->nodeValue.'})();');
                        }

                        continue;
                    }
                }
            }
        }

        $render = '';

        if ($body = $dom->getElementsByTagName('body')->item(0)) {
            foreach ($body->childNodes as $child) {
                if ($child instanceof DOMElement) {
                    if ($child->tagName == 'style' && !empty($child->nodeValue)) {
                        static::style($child->nodeValue);
                        continue;
                    }

                    if ($child->tagName == 'script' && !empty($child->nodeValue)) {
                        static::script(';(function () {'.$child->nodeValue.'})();');
                        continue;
                    }

                    if ($child->tagName == 'template') {
                        $html = '';
                        foreach ($child->childNodes as $childNode) {
                            $html .= $child->ownerDocument->saveHTML($childNode);
                        }
                        $html && static::html($html);
                        continue;
                    }
                }

                $render .= $body->ownerDocument->saveHTML($child);
            }
        }

        return trim($render);
    }
}
