<?php

namespace Elegance\Admin\Table\Actions;

use Elegance\Admin\Actions\Response;
use Elegance\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Destroy extends RowAction
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
        return __('admin.destroy');
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->parent->resource().'/'.$this->getKey();
    }

    /**
     * @return void
     */
    public function dialog()
    {
        $this->question(trans('admin.destroy_confirm'), '', ['confirmButtonColor' => '#d33']);
    }
}
