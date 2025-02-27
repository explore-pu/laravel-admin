<?php

namespace Elegance\Admin\Table\Displayers;

use Elegance\Admin\Admin;
use Elegance\Admin\Table\Simple;
use Illuminate\Contracts\Support\Renderable;

class Expand extends AbstractDisplayer
{
    protected $renderable;

    public function display($callback = null, $isExpand = false)
    {
        $html = '';
        $async = false;
        $loadTable = false;

        if (is_subclass_of($callback, Renderable::class)) {
            $this->renderable = $callback;
            $async = true;
            $loadTable = is_subclass_of($callback, Simple::class);
        } else {
            $html = call_user_func_array($callback->bindTo($this->row), [$this->row]);
        }

        return Admin::view('admin::table.display.expand', [
            'key'           => $this->getKey(),
            'url'           => $this->getLoadUrl(),
            'name'          => str_replace('.', '-', $this->getName()).'-'.$this->getKey(),
            'html'          => $html,
            'value'         => $this->value,
            'async'         => $async,
            'expand'        => $isExpand,
            'loadTable'     => $loadTable,
            'elementClass'  => 'table-expand-table-row',
        ]);
    }

    /**
     * @param int $multiple
     *
     * @return string
     */
    protected function getLoadUrl()
    {
        $renderable = str_replace('\\', '_', $this->renderable);

        return route('handle_renderable', compact('renderable'));
    }
}
