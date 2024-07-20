<?php

namespace Elegant\Utils\Table\Actions;

use Elegant\Utils\Actions\Response;
use Elegant\Utils\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Delete extends RowAction
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
        return __('admin.delete');
    }

    /**
     * @return string
     */
    public function getHandleUrl()
    {
        return $this->parent->resource().'/'.$this->getKey().'/delete';
    }

    /**
     * @return void
     */
    public function dialog()
    {
        $this->question(trans('admin.delete_confirm'));
    }
}
