<?php

namespace Elegant\Admin\Table\Displayers;

use Elegant\Admin\Admin;

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        return Admin::view('admin::table.display.row-selector', ['key' => $this->getKey()]);
    }
}
