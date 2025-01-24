<?php

namespace Elegance\Admin\Actions;

use Elegance\Admin\Table\Column;
use Elegance\Admin\Table\Displayers\DropdownActions;
use Illuminate\Http\Request;

abstract class RowAction extends TableAction
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $row;

    protected $actions = DropdownActions::class;

    /**
     * @var Column
     */
    protected $column;

    /**
     * @var string
     */
    public $selectorPrefix = '.table-row-action-';

    /**
     * @var bool
     */
    protected $asColumn = false;

    /**
     * @var bool
     */
    public $dblclick = false;

    /**
     * Get primary key value of current row.
     *
     * @return mixed
     */
    protected function getKey()
    {
        return $this->row->getKey();
    }

    /**
     * Set row model.
     *
     * @param mixed $key
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function row($key = null)
    {
        if ($key instanceof \Closure) {
            return $this->interactor->row($key);
        }

        if (func_num_args() == 0) {
            return $this->row;
        }

        return $this->row->getAttribute($key);
    }

    /**
     * Set row model.
     *
     * @param \Illuminate\Database\Eloquent\Model $row
     *
     * @return $this
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param Column $column
     *
     * @return $this
     */
    public function setColumn(Column $column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Show this action as a column.
     *
     * @return $this
     */
    public function asColumn()
    {
        $this->asColumn = true;

        return $this;
    }

    /**
     * @return string
     */
    public function href()
    {
    }

    /**
     * Double-click table row to activate this action.
     *
     * @return $this
     */
    public function dblclick()
    {
        $this->dblclick = true;

        return $this;
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

    public function display($value)
    {
    }

    public function getElementClass()
    {
        $elementClass = parent::getElementClass();

        if ($this->actions instanceof DropdownActions || $this->actions === 'Elegance\Admin\Table\Displayers\DropdownActions') {
            $elementClass .= ' dropdown-item';
        }

        return $elementClass;
    }

    /**
     * @return string
     */
    public function getActiontElementClass()
    {
        return parent::getElementClass();
    }

    /**
     * Render row action.
     *
     * @return string
     */
    public function render()
    {
        if ($href = $this->href()) {
            return "<a href='{$href}' class='{$this->getElementClass()}'>{$this->name()}</a>";
        }

        $this->addScript();

        $attributes = $this->formatAttributes();

        return sprintf(
            "<a data-_key='%s' href='javascript:void(0);' class='%s' {$attributes}>%s</a>",
            $this->getKey(),
            $this->getElementClass(),
            $this->asColumn ? $this->display($this->row($this->column->getName())) : $this->name()
        );
    }
}
