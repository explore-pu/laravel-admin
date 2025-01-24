<?php

namespace Elegance\Admin\Form\Actions;

use Elegance\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

class View implements Renderable
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render()
    {
        return Admin::view('admin::form.actions.view', ['path' => $this->path]);
    }
}
