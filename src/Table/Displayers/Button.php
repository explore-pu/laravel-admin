<?php

namespace Elegance\Admin\Table\Displayers;

class Button extends AbstractDisplayer
{
    public function display($style = null)
    {
        $style = collect((array) $style)->map(function ($style) {
            return 'btn-'.$style;
        })->implode(' ');

        return "<span class='btn $style'>{$this->value}</span>";
    }
}
