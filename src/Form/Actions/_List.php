<?php

namespace Elegant\Admin\Form\Actions;

use Elegant\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

class _List implements Renderable
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render()
    {
        return Admin::view('admin::form.actions.list', ['path' => $this->path]);
    }
}
