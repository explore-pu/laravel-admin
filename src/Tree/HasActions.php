<?php

namespace Elegant\Admin\Tree;

use Closure;
use Elegant\Admin\Tree\Displayers\IconActions;

trait HasActions
{
    /**
     * Callback for grid actions.
     *
     * @var Closure
     */
    protected $actionsCallback;

    /**
     * Actions column display class.
     *
     * @var string
     */
    protected $actionsClass;

    /**
     * @var bool
     */
    protected $show_actions = true;

    /**
     * Set grid action callback.
     *
     * @param Closure|string $actions
     *
     * @return $this
     */
    public function actions($actions)
    {
        if ($actions instanceof Closure) {
            $this->actionsCallback = $actions;
        }

        return $this;
    }

    /**
     * Get action display class.
     *
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function getActionClass()
    {
        if ($this->actionsClass) {
            return $this->actionsClass;
        }

        return IconActions::class;
    }

    /**
     * @param string $actionClass
     *
     * @return $this
     */
    public function setActionClass(string $actionClass)
    {
        $this->actionsClass = $actionClass;

        return $this;
    }

    /**
     * Disable all actions.
     *
     * @return bool
     */
    public function disableActions()
    {
        return $this->show_actions = true;
    }

    protected function using($abstract)
    {
        return new $abstract($this, $this->trashed, $this->requestTrashed());
    }

    /**
     * @param $row
     * @return mixed|void
     */
    protected function appendActions()
    {
        if (!$this->show_actions) {
            return;
        }

        return $this->using($this->getActionClass());
    }
}
