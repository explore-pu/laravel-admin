<?php

namespace Elegant\Utils\Tree\Actions;

use Elegant\Utils\Actions\TreeAction;

class ColumnEdit extends TreeAction
{
    /**
     * @var string
     */
    protected $column = '';

    /**
     * @var string
     */
    protected $label = '';

    /**
     * @var string
     */
    protected $default = '';

    /**
     * @param string $column
     * @param string $label
     * @return $this
     */
    public function setColumn(string $column, string $label = '')
    {
        $this->column = $column;

        $this->label = $label ?: ucfirst($column);

        return $this;
    }

    /**
     * @param string $default
     * @return $this
     */
    public function setDefault(string $default = '')
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function name()
    {
        return admin_trans('admin.edit');
    }

    /**
     * @return string
     */
    protected function icon()
    {
        return 'fa-edit';
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->getResource() . "/" . $this->getKey();
    }

    /**
     * edit form
     */
    public function form()
    {
        $this->hidden('_method')->value('PUT');
        $this->text($this->column, $this->label)->default($this->default)->required();
    }
}
