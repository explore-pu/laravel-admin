<?php

namespace Elegant\Utils\Table\Displayers;

use Elegant\Utils\Admin;
use Illuminate\Support\Arr;

class Checkbox extends AbstractDisplayer
{
    public function display($options = [])
    {
        return Admin::view('admin::table.inline-edit.checkbox', [
            'key'      => $this->getKey(),
            'name'     => $this->getPayloadName(),
            'resource' => $this->getResource(),
            'trigger'  => "ie-trigger-{$this->getClassName()}",
            'target'   => "ie-content-{$this->getClassName()}-{$this->getKey()}",
            'value'    => json_encode($this->getValue()),
            'display'  => implode(';', Arr::only($options, $this->getValue())),
            'options'  => $options,
        ]);
    }
}
