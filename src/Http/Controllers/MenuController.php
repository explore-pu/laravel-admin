<?php

namespace Elegant\Admin\Http\Controllers;

use Elegant\Admin\Form;
use Elegant\Admin\Layout\Column;
use Elegant\Admin\Layout\Content;
use Elegant\Admin\Layout\Row;
use Elegant\Admin\Models\MenuGroup;
use Elegant\Admin\Tree;

class MenuController extends AdminController
{

    public function model()
    {
        return config('admin.database.menus_model');
    }

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title(trans('admin.menus'))
            ->description(trans('admin.list'))
            ->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Elegant\Admin\Widgets\Form();
                    $form->title(trans('admin.new'));
                    $form->action(admin_url('menus'));

                    $form->select('group', trans('admin.group'))->default(1)->options(MenuGroup::selectOptions());
                    $form->select('parent_id', trans('admin.parent_id'))->default(0)->options($this->model::selectOptions());
                    $form->text('title', trans('admin.title'))->rules('required')->prepend(new Form\Field\Icon('icon'));
                    $form->text('uri', trans('admin.uri'));
                    $form->hidden('_saved')->default(1);

                    $column->append($form);
                });
            });
    }

    /**
     * @return Tree
     */
    protected function treeView()
    {
        $tree = new Tree(new $this->model());

        $tree->disableCreate();

        $tree->branch(function ($branch) {
            $payload = "<i class='{$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

            if (!isset($branch['children'])) {
                if (url()->isValidUrl($branch['uri'])) {
                    $uri = $branch['uri'];
                } else {
                    $uri = admin_url($branch['uri']);
                }

                $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag d-none d-md-inline-block\">$uri</a>";
            }

            return $payload;
        });

        $tree->actions(function (Tree\Displayers\Actions $actions) {
//            $actions->useColumnEdit('title', admin_trans('title'));
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
     * Edit interface.
     *
     * @param string  $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title(trans('admin.menus'))
            ->description(trans('admin.edit'))
            ->row($this->form()->edit($id));
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

        $form->select('group', trans('admin.group'))->options(MenuGroup::selectOptions());
        $form->select('parent_id', trans('admin.parent_id'))->options($this->model::selectOptions());
        $form->text('title', trans('admin.title'))->rules('required')->prepend(new Form\Field\Icon('icon'));
        $form->text('uri', trans('admin.uri'));

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }
}
