<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Form;
use Elegance\Admin\Layout\Column;
use Elegance\Admin\Layout\Content;
use Elegance\Admin\Layout\Row;
use Elegance\Admin\Models\MenuGroup;
use Elegance\Admin\Tree;

class PermissionController extends AdminController
{
    /**
     * @var array|string[]
     */
    protected array $methods = [
        'HEAD' => 'HEAD',
        'POST' => 'POST',
        'PATCH' => 'PATCH',
        'PUT' => 'PUT',
        'DELETE' => 'DELETE',
    ];

    public function title()
    {
        return trans('admin.permissions');
    }

    public function model()
    {
        return config('admin.database.permission_model');
    }

    /**
     * @return Tree
     */
    protected function table()
    {
        $tree = new Tree(new $this->model());

//        $tree->disableCreate();

        $tree->branch(function ($branch) {
            $type = $this->type($branch['type']);

            $payload = "<i class='{$branch['icon']}'></i>";

            $payload .= "&nbsp;<strong>{$branch['title']}</strong>";

            $payload .= "&nbsp;<span>[{$type}]</span>";

            if (url()->isValidUrl($branch['uri'])) {
                $uri = $branch['uri'];
            } else {
                $uri = admin_url($branch['uri']);
            }

            $payload .= "&nbsp;&nbsp;<span class=\"d-none d-md-inline-block\">[{$branch['method']}]</span>&nbsp;<a href=\"$uri\" class=\"dd-nodrag d-none d-md-inline-block\">$uri</a>";

            return $payload;
        });

        $tree->actions(function (Tree\Displayers\Actions $actions) {
//            $actions->useColumnEdit('title', trans('title'));
            if ($actions->trashed && $actions->requestTrashed) {
                $actions->disableEdit();
                $actions->disableDestroy();
            }

            if ($actions->row['deleted_at']) {
                $actions->add(new Tree\Actions\Restore());
                $actions->add(new Tree\Actions\Delete());
            }
        });

        return $tree;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $form = new Form(new $this->model());

        $form->display('id', 'ID');

        $form->select('parent_id', trans('admin.parent_id'))->default(0)->options($this->model::selectOptions());
        $form->radio('type', trans('admin.type'))->options($this->type())->default(1);
        $form->text('title', trans('admin.title'))->rules('required')
            ->prepend(new Form\Field\Icon('icon'));
        $form->text('uri', trans('admin.uri'))
            ->prepend((new Form\Field\Select('method'))->options($this->methods)->default('HEAD'));

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }

    protected function type($code = null)
    {
        $types = [
            1 => trans('admin.menu'),
            2 => trans('admin.page'),
            3 => trans('admin.action'),
        ];

        if ($code !== null) {
            return $types[$code];
        }

        return $types;
    }
}
