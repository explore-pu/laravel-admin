<?php

namespace Elegance\Admin\Table\Tools;

use Elegance\Admin\Admin;
use Elegance\Admin\Table;

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
