<?php

namespace Elegance\Admin\Tree\Actions;

use Elegance\Admin\Actions\TreeAction;

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
        return trans('admin.delete');
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
        $this->question(trans('admin.delete_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
