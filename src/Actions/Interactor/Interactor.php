<?php

namespace Elegance\Admin\Actions\Interactor;

use Elegance\Admin\Actions\Action;

abstract class Interactor
{
    /**
     * @var Action
     */
    protected $action;

    /**
     * @var array
     */
    public static $elements = [
        'success', 'error', 'warning', 'info', 'question', 'confirm',
        'text', 'email', 'integer', 'ip', 'url', 'password', 'mobile',
        'textarea', 'select', 'multipleSelect', 'checkbox', 'checkboxTree', 'radio',
        'file', 'image', 'date', 'datetime', 'time', 'hidden', 'multipleImage',
        'multipleFile', 'modalLarge', 'modalSmall',
    ];

    /**
     * Dialog constructor.
     *
     * @param Action $action
     */
    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    abstract public function addScript(array $data = []);
}
