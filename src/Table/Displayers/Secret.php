<?php

namespace Elegant\Utils\Table\Displayers;

use Elegant\Utils\Admin;

class Secret extends AbstractDisplayer
{
    public function display($dotCount = 6)
    {
        return Admin::view('admin::table.display.secret', [
            'value' => $this->getValue(),
            'dots'  => str_repeat('*', $dotCount),
        ]);
    }
}
