<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Admin;

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        return Admin::view('admin::table.display.row-selector', ['key' => $this->getKey()]);
    }
}
