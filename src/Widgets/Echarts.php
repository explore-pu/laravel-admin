<?php

namespace Elegance\Admin\Widgets;

use Elegance\Admin\Facades\Admin;
use Illuminate\Contracts\Support\Renderable;

class Echarts extends Widget implements Renderable
{
    protected $view = 'admin::widgets.echarts';

    protected string $element = '';

    protected string $scripts = '';

    protected int $height = 300;

    public function __construct(string $element)
    {
        $this->element = $element;
    }

    public function scripts(string $scripts): static
    {
        $this->scripts = $scripts;

        return $this;
    }

    public function height(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function render(): string
    {
        return Admin::view($this->view, [
            'element' => $this->element,
            'selector' => '.' . $this->element,
            'nested' => false,
            'scripts' => $this->scripts,
            'height' => $this->height,
        ]);
    }
}
