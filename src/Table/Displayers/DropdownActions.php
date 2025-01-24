<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Actions\RowAction;
use Elegance\Admin\Admin;
use Elegance\Admin\Table\Actions\Delete;
use Elegance\Admin\Table\Actions\Destroy;
use Elegance\Admin\Table\Actions\Edit;
use Elegance\Admin\Table\Actions\EditModal;
use Elegance\Admin\Table\Actions\View;
use Illuminate\Support\Arr;

class DropdownActions extends Actions
{
    protected $view = 'admin::table.actions.dropdown';

    /**
     * @var array
     */
    protected $custom = [];

    /**
     * @var array
     */
    protected $default = [];

    /**
     * @var array
     */
    protected $defaultClass = [Edit::class, View::class, Destroy::class];

    /**
     * @var string
     */
    protected $dblclick;

    /**
     * @param RowAction $action
     *
     * @return $this
     */
    public function add(RowAction $action)
    {
        $this->prepareAction($action);

        array_push($this->custom, $action);

        return $this;
    }

    /**
     * Prepend default `edit` `view` `delete` actions.
     */
    protected function prependDefaultActions()
    {
        foreach ($this->defaultClass as $class) {
            if ($this->table->modalForm && $class == Edit::class) {
                $class = EditModal::class;
            }

            /** @var RowAction $action */
            $action = new $class();

            $action->setActions($this);

            $this->prepareAction($action);

            array_push($this->default, $action);
        }
    }

    /**
     * @param RowAction $action
     */
    protected function prepareAction(RowAction $action)
    {
        $action->setTable($this->table)
            ->setColumn($this->column)
            ->setRow($this->row);
    }

    /**
     * Disable view action.
     *
     * @param bool $disable
     *
     * @return $this
     */
    public function disableView(bool $disable = true)
    {
        if ($disable) {
            array_delete($this->defaultClass, View::class);
        } elseif (!in_array(View::class, $this->defaultClass)) {
            array_push($this->defaultClass, View::class);
        }

        return $this;
    }

    /**
     * Disable destroy.
     *
     * @param bool $disable
     *
     * @return $this
     */
    public function disableDestroy(bool $disable = true)
    {
        if ($disable) {
            array_delete($this->defaultClass, Destroy::class);
        } elseif (!in_array(Destroy::class, $this->defaultClass)) {
            array_push($this->defaultClass, Destroy::class);
        }

        return $this;
    }

    /**
     * Disable edit.
     *
     * @param bool $disable
     *
     * @return $this
     */
    public function disableEdit(bool $disable = true)
    {
        if ($disable) {
            array_delete($this->defaultClass, Edit::class);
        } elseif (!in_array(Edit::class, $this->defaultClass)) {
            array_push($this->defaultClass, Edit::class);
        }

        return $this;
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function dblclick(string $action)
    {
        $this->dblclick = Arr::get([
            'edit'      => Edit::class,
            'view'      => View::class,
            'delete'    => Destroy::class,
            'select'    => 'select',
        ], $action);

        return $this;
    }

    /**
     * @return string
     */
    protected function getDblclickElement()
    {
        if ($this->dblclick == 'select') {
            return 'table-row-checkbox';
        }

        $dblclick = '';

        foreach (array_merge($this->default, $this->custom) as $action) {

            // activate defalut action dblclick
            if ($this->dblclick && $action instanceof $this->dblclick) {
                $dblclick = $action->getActiontElementClass();
                break;
            }

            if ($action->dblclick) {
                $dblclick = $action->getActiontElementClass();
            }
        }

        return $dblclick;
    }

    /**
     * @param []\Closure $callback
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function display($callback = [])
    {
        if (is_array($callback) && !empty($callback)) {
            foreach ($callback as $item) {
                $item->call($this, $this);
            }
        }

        if ($this->disableAll) {
            return '';
        }

        $this->prependDefaultActions();

        $variables = [
            'default'  => $this->default,
            'custom'   => $this->custom,
            'dblclick' => $this->getDblclickElement(),
            'table'    => $this->table->tableID,
        ];

        if (empty($variables['default']) && empty($variables['custom'])) {
            return;
        }

        return Admin::view($this->view, $variables);
    }
}
