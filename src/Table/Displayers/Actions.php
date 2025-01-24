<?php

namespace Elegance\Admin\Table\Displayers;

abstract class Actions extends AbstractDisplayer
{
    protected $disableAll = false;

    abstract public function display();
}
