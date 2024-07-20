<?php

namespace Elegant\Admin\Tree\Actions;

use Elegant\Admin\Actions\TreeAction;

class Delete extends TreeAction
{
    /**
     * @var string
     */
    protected $method = 'DELETE';

    /**
     * @return array|null|string
     */
    public function name()
    {
        return admin_trans('admin.delete');
    }

    /**
     * @return string
     */
    protected function icon()
    {
        return 'fa-trash';
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->getResource() . "/" . $this->getKey() . "/delete";
    }

    /**
     * @return void
     */
    public function dialog()
    {
        $this->question(admin_trans('admin.delete_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
