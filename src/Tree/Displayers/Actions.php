<?php

namespace Elegant\Admin\Tree\Displayers;

abstract class Actions extends AbstractDisplayer
{
    /**
     * Disable all actions.
     *
     * @var bool
     */
    protected $disableAll = false;

    /**
     * Disable all actions.
     *
     * @return $this
     */
    public function disableAll()
    {
        $this->disableAll = true;

        return $this;
    }

    abstract public function display();
}
