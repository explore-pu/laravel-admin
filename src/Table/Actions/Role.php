<?php

namespace Elegance\Admin\Table\Actions;

use Elegance\Admin\Actions\RowAction;

class Role extends RowAction
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

        $roleModel = config('admin.database.role_model');
        $permissionModel = config('admin.database.permission_model');

        $roles = $roleModel::with(['permissions'])->get();
        $rolePermissions = $roles->pluck('permissions', 'id')->toArray();
        array_walk($rolePermissions, function (&$value, $key) {
            $value = array_column($value, 'id');
        });

        $this->multipleSelect('roles', trans('admin.roles'))
            ->options($roleModel::pluck('name', 'id'))
            ->optionDataAttributes('permissions', $rolePermissions)
            ->config('maximumSelectionLength', config('admin.database.user_maximum_roles', '0'))
            ->value($this->row->roles->pluck('id')->toArray());

        $this->checkboxTree('permissions', trans('admin.permissions'))
            ->options((new $permissionModel())->toTree())
            ->related('roles', 'permissions')->value($this->row->permissions->pluck('id')->toArray());
    }
}
