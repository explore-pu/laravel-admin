<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Admin;
use Illuminate\Support\Arr;

class Select extends AbstractDisplayer
{
    public function display($options = [])
    {
        return Admin::view('admin::table.inline-edit.select', [
            'key'      => $this->getKey(),
            'value'    => $this->getValue(),
            'display'  => Arr::get($options, $this->getValue(), ''),
            'name'     => $this->getPayloadName(),
            'resource' => $this->getResource(),
            'trigger'  => "ie-trigger-{$this->getClassName()}",
            'target'   => "ie-template-{$this->getClassName()}",
            'options'  => $options,
        ]);
    }
}
