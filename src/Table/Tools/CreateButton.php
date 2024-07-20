<?php

namespace Elegant\Admin\Table\Tools;

use Elegant\Admin\Admin;
use Elegant\Admin\Table;

class CreateButton extends AbstractTool
{
    /**
     * @var Table
     */
    protected $table;

    /**
     * Create a new CreateButton instance.
     *
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Render CreateButton.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->table->showCreateBtn()) {
            return '';
        }

        return Admin::view('admin::table.create-btn', [
            'url'   => $this->table->getCreateUrl(),
            'modal' => $this->table->modalForm,
        ]);
    }
}
