<?php

namespace Elegant\Utils\Table\Displayers;

use Elegant\Utils\Admin;

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
