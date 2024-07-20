<?php

namespace Elegant\Utils\Table\Actions;

use Elegant\Utils\Actions\Response;
use Elegant\Utils\Actions\RowAction;
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
