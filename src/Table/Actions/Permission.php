<?php

namespace Elegance\Admin\Table\Actions;

use Elegance\Admin\Actions\RowAction;

class Permission extends RowAction
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @return string
     */
    public function name()
    {
        return trans('admin.authorization');
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->parent->resource().'/'.$this->getKey().'/authorization';
    }

    /**
     * @return void
     */
    public function form()
    {
        $this->modalLarge();

        $permissionModel = config('admin.database.permission_model');

        $this->checkboxTree('permissions', trans('admin.route_permissions'))
            ->options((new $permissionModel())->toTree())->value($this->row->permissions->pluck('id')->toArray());
    }
}
