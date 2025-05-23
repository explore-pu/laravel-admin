<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Admin;

class TreeDisplay extends AbstractDisplayer
{
    public function display()
    {
        return Admin::view('admin::table.display.tree', [
            'key'          => $this->getKey(),
            'parent'       => $this->row->getParentKey(),
            'value'        => $this->getValue(),
            'has_children' => $this->getAttribute('__has_children'),
            'space'        => $this->getAttribute('__space'),
        ]);
    }
}
