<?php

namespace Elegant\Admin\Widgets\Navbar;

use Elegant\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

class RefreshButton implements Renderable
{
    public function render()
    {
        return Admin::view('admin::components.refresh-btn');
    }
}
