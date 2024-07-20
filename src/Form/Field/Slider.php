<?php

namespace Elegant\Admin\Form\Field;

use Elegant\Admin\Form\Field;

class Slider extends Field
{
    protected $options = [
        'type'      => 'single',
        'prettify'  => false,
        'hasTable'  => true,
    ];

    public function render()
    {
        $this->addVariables(['options' => $this->options]);

        return parent::render();
    }
}
