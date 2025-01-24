<?php

namespace Elegance\Admin\Widgets\Navbar;

use Elegance\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class FullScreen.
 *
 * @see  https://javascript.ruanyifeng.com/htmlapi/fullscreen.html
 */
class Fullscreen implements Renderable
{
    public function render()
    {
        return Admin::view('admin::components.fullscreen');
    }
}
