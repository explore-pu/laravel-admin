<?php

namespace Elegant\Admin\Table\Displayers;

use Elegant\Admin\Admin;

/**
 * Class QRCode.
 */
class QRCode extends AbstractDisplayer
{
    public function display($formatter = null, $width = 150, $height = 150)
    {
        $content = $this->getOriginalValue();
        $value = $this->getValue();

        if ($formatter instanceof \Closure) {
            $content = call_user_func($formatter, $content, $this->row);
        }

        return Admin::view('admin::table.display.qrcode', compact('value', 'width', 'height', 'content'));
    }
}
