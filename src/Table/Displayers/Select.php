<?php

namespace Elegant\Utils\Table\Displayers;

use Elegant\Utils\Admin;
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
