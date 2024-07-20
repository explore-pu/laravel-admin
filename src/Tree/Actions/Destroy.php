<?php

namespace Elegant\Admin\Tree\Actions;

use Elegant\Admin\Actions\TreeAction;

class Destroy extends TreeAction
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
        return admin_trans('admin.destroy');
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
        return $this->getResource() . "/" . $this->getKey();
    }

    /**
     * @return void
     */
    public function dialog()
    {
        $this->question(admin_trans('admin.destroy_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
