<?php

namespace Elegant\Utils\Tree\Actions;

use Elegant\Utils\Actions\TreeAction;

class Restore extends TreeAction
{
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @return array|null|string
     */
    public function name()
    {
        return admin_trans('admin.restore');
    }

    protected function icon()
    {
        return 'fa-undo';
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->getResource() . "/" . $this->getKey() ."/restore";
    }

    /**
     * @return void
     */
    public function dialog()
    {
        $this->question(admin_trans('admin.restore_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
