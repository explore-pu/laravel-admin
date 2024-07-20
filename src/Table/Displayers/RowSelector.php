<?php

namespace Elegant\Utils\Table\Displayers;

use Elegant\Utils\Admin;

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        return Admin::view('admin::table.display.row-selector', ['key' => $this->getKey()]);
    }
}
