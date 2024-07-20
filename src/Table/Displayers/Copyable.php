<?php

namespace Elegant\Admin\Table\Displayers;

use Elegant\Admin\Admin;

/**
 * Class Copyable.
 *
 * @see https://codepen.io/shaikmaqsood/pen/XmydxJ
 */
class Copyable extends AbstractDisplayer
{
    public function display()
    {
        return Admin::view('admin::table.display.copyable', [
            'value'    => $this->getValue(),
            'original' => $this->getOriginalValue(),
        ]);
    }
}
