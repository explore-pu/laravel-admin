<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Admin;

class Upload extends AbstractDisplayer
{
    public function display($multiple = false)
    {
        return Admin::view('admin::table.inline-edit.upload', [
            'key'      => $this->getKey(),
            'name'     => $this->getPayloadName(),
            'value'    => $this->getValue(),
            'target'   => "inline-upload-{$this->getKey()}",
            'resource' => $this->getResource(),
            'multiple' => $multiple,
        ]);
    }
}
