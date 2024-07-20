<?php

namespace Elegant\Admin\Actions;

use Elegant\Admin\Tree;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * Class TreeAction
 */
abstract class TreeAction extends Action
{
    /**
     * @var string
     */
    public $selectorPrefix = '.tree-row-action-';

    /**
     * @var string
     */
    protected $icon = 'fa-bars';

    /**
     * @var Tree
     */
    protected $parent;

    /**
     * @var array
     */
    protected $row;

    /**
     * @return string
     */
    protected function icon()
    {
        return $this->icon;
    }

    /**
     * @param Tree $tree
     * @return $this
     */
    public function setTree(Tree $tree)
    {
        $this->parent = $tree;

        return $this;
    }

    /**
     * @param array $row
     * @return $this
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * Get url path of current resource.
     *
     * @return string
     */
    public function getResource()
    {
        return $this->parent->resource();
    }

    /**
     * Get primary key value of current row.
     *
     * @return mixed
     */
    protected function getKey()
    {
        return $this->row[$this->parent->getKeyName()];
    }

    /**
     * @return array
     */
    public function parameters()
    {
        return ['_model' => $this->getModelClass()];
    }

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        $model = $this->parent->model();

        return str_replace('\\', '_', get_class($model));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function retrieveModel(Request $request)
    {
        if (!$key = $request->get('_key')) {
            return false;
        }

        $modelClass = str_replace('_', '\\', $request->get('_model'));

        if ($this->modelUseSoftDeletes($modelClass)) {
            return $modelClass::withTrashed()->findOrFail($key);
        }

        return $modelClass::findOrFail($key);
    }

    /**
     * Indicates if model uses soft-deletes.
     *
     * @param $modelClass
     *
     * @return bool
     */
    protected function modelUseSoftDeletes($modelClass)
    {
        return in_array(SoftDeletes::class, class_uses_deep($modelClass));
    }

    /**
     * @return string
     */
    public function href()
    {
        return '';
    }

    /**
     * Render row action.
     *
     * @return string
     */
    public function render()
    {
        if ($href = $this->href()) {
            return "<a href='{$href}' title='{$this->name()}'><i class='fa {$this->icon()}'></i></a>";
        }

        $this->addScript();

        $attributes = $this->formatAttributes();

        return "<a data-_key='{$this->getKey()}' href='javascript:void(0);' class='{$this->getElementClass()}' title='{$this->name()}' {$attributes}><i class='fa {$this->icon()}'></i></a>";
    }
}
