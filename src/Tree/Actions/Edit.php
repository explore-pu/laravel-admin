<?php

namespace Elegant\Admin\Tree\Actions;

use Elegant\Admin\Actions\TreeAction;

class Edit extends TreeAction
{
    /**
     * @return array|null|string
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
    public function href()
    {
        return $this->getResource() . "/" . $this->getKey() . "/edit";
    }
}
