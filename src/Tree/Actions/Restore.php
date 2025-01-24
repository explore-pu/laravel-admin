<?php

namespace Elegance\Admin\Tree\Actions;

use Elegance\Admin\Actions\TreeAction;

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
        return trans('admin.restore');
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
        $this->question(trans('admin.restore_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
