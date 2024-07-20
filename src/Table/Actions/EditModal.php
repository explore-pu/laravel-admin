<?php

namespace Elegant\Admin\Table\Actions;

use Elegant\Admin\Admin;

class EditModal extends Edit
{
    /**
     * @throws \Throwable
     *
     * @return string
     */
    public function render()
    {
        return Admin::view('admin::table.actions.editmodal', [
            'selector' => $this->getActiontElementClass(),
            'name'     => $this->name(),
            'url'      => $this->href(),
        ]);
    }
}
