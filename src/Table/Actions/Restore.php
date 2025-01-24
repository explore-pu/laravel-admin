<?php

namespace Elegance\Admin\Table\Actions;

use Elegance\Admin\Actions\Response;
use Elegance\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Restore extends RowAction
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
        return __('admin.restore');
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->parent->resource().'/'.$this->getKey().'/restore';
    }

    /**
     * @return void
     */
    public function dialog()
    {
        $this->question(trans('admin.restore_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
