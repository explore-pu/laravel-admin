<?php

namespace Elegance\Admin\Form\Actions;

use Elegance\Admin\Actions\Action as BaseAction;
use Illuminate\Database\Eloquent\Model;

class Action extends BaseAction
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     *
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }
}
