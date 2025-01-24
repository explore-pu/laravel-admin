<?php

namespace Elegance\Admin\Table\Selectable;

use Illuminate\Contracts\Support\Renderable;

class BrowserBtn implements Renderable
{
    public function render()
    {
        $text = trans('admin.choose');

        $html = <<<HTML
<a href="javascript:void(0)" class="btn btn-%s btn-sm float-left select-relation">
    <i class="fas fa-folder-open"></i>
    &nbsp;{$text}
</a>
HTML;

        return admin_color($html);
    }
}
