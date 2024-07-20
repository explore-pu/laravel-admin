<?php

namespace Elegant\Utils\Form\Actions;

use Elegant\Utils\Admin;
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
