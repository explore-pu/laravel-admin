<?php

namespace Elegant\Admin\Show\Actions;

use Illuminate\Contracts\Support\Renderable;

class Edit implements Renderable
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render()
    {
        $text = trans('admin.edit');

        $html = <<<HTML
<div class="btn-group float-right" style="margin-right: 5px">
    <a href="{$this->path}" class="btn btn-sm btn-%s" title="{$text}">
        <i class="fa fa-edit"></i><span class="d-none d-md-inline-block"> {$text}</span>
    </a>
</div>
HTML;

        return admin_color($html);
    }
}
