<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Admin;
use Illuminate\Support\Arr;

class MultipleSelect extends AbstractDisplayer
{
    public function display($options = [])
    {
        return Admin::view('admin::table.inline-edit.multiple-select', [
            'key'      => $this->getKey(),
            'name'     => $this->getPayloadName(),
            'value'    => json_encode($this->getValue()),
            'resource' => $this->getResource(),
            'trigger'  => "ie-trigger-{$this->getClassName()}",
            'target'   => "ie-template-{$this->getClassName()}",
            'display'  => implode(';', Arr::only($options, $this->getValue())),
            'options'  => $options,
        ]);
    }
}
