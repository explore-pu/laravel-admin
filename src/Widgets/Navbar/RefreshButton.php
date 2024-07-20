<?php

namespace Elegant\Utils\Widgets\Navbar;

use Elegant\Utils\Admin;
use Illuminate\Contracts\Support\Renderable;

class RefreshButton implements Renderable
{
    public function render()
    {
        return Admin::view('admin::components.refresh-btn');
    }
}
