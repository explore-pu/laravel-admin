<?php

namespace Elegant\Utils\Table\Displayers;

use Elegant\Utils\Admin;

class Orderable extends AbstractDisplayer
{
    public function display()
    {
        if (!trait_exists('\Spatie\EloquentSortable\SortableTrait')) {
            throw new \Exception('To use orderable table, please install package [spatie/eloquent-sortable] first.');
        }

        return Admin::view('admin::table.display.orderable', [
            'key'      => $this->getKey(),
            'resource' => $this->getResource(),
        ]);
    }
}
