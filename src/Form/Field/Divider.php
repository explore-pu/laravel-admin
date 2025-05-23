<?php

namespace Elegance\Admin\Form\Field;

use Elegance\Admin\Form\Field;

class Divider extends Field
{
    protected $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function render()
    {
        if (empty($this->title)) {
            return '<hr>';
        }

        return <<<HTML
<div style="height: 20px;" class="text-center my-5 border-bottom">
  <span style="font-size: 18px; background-color: #ffffff; padding: 0 10px;">
    {$this->title}
  </span>
</div>
HTML;
    }
}
