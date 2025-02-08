<?php

namespace Elegance\Admin\Widgets;

use Elegance\Admin\Facades\Admin;
use Illuminate\Contracts\Support\Renderable;

class Echarts extends Widget implements Renderable
{
    /**
     * @var string
     */
    protected $view = 'admin::widgets.echarts';

    /**
     * @var string
     */
    protected string $element = '';

    /**
     * @var string
     */
    protected string $scripts = '';

    /**
     * @var int
     */
    protected int $height = 300;

    /**
     * @param string $element
     */
    public function __construct(string $element)
    {
        $this->element = $element;
    }

    /**
     * @param string $scripts
     * @return $this
     */
    public function scripts(string $scripts): static
    {
        $this->scripts = $scripts;

        return $this;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function height(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
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
