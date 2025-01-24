<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Form;
use Elegance\Admin\Show;
use Elegance\Admin\Table;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends AdminController
{
    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function title()
    {
        return trans('admin.roles');
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Foundation\Application|mixed|null
     */
    public function model()
    {
        return config('admin.database.role_model');
    }

    /**
     * Make a table builder.
     *
     * @return Table
     */
    public function table()
    {
        $table = new Table(new $this->model());
        $table->model()->with('permissions')->orderByDesc('id');

        $table->column('id', 'ID')->sortable();
        $table->column('name', trans('admin.name'));
        $table->column('slug', trans('admin.slug'));
        $table->column('created_at', trans('admin.created_at'));
        $table->column('updated_at', trans('admin.updated_at'));

        $table->actions(function (Table\Displayers\Actions $actions) {
            if ($actions->row->slug == 'administrator') {
                $actions->disableDestroy();
            }
            if ($actions->row->deleted_at) {
                $actions->disableEdit();
                $actions->disableView();
                $actions->disableDestroy();
                $actions->add(new Table\Actions\Restore());
                $actions->add(new Table\Actions\Delete());
            }

            if ($actions->getKey() !== 1) {
                $actions->add(new Table\Actions\Permission());
            }
        });

        $table->tools(function (Table\Tools $tools) {
            $tools->batch(function (Table\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });

        $table->filter(function(Table\Filter $filter){
            $filter->disableIdFilter();
            $filter->scope('trashed', trans('admin.trashed'))->onlyTrashed();
            $filter->like('name', trans('admin.name'));
            $filter->like('slug', trans('admin.slug'));
        });

        return $table;
    }

    /**
     * Make a show builder.
     *
     * @param $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show($this->model::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', trans('admin.name'));
        $show->field('slug', trans('admin.slug'));
        $show->field('created_at', trans('admin.created_at'));
        $show->field('updated_at', trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $form = new Form(new $this->model());

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });

        $form->display('id', 'ID');
        $form->row(function (Form\Layout\Row $row) {
            $row->column(6, function (Form\Layout\Column $column) {
                $column->text('name', trans('admin.name'))
                    ->creationRules(['required', "unique:{$this->model}"])
                    ->updateRules(['required', "unique:{$this->model},name,{{id}}"]);
            });
            $row->column(6, function (Form\Layout\Column $column) {
                $column->text('slug', trans('admin.slug'))
                    ->with(function ($value, Form\Field $field) {
                        if ($value == 'administrator') {
                            $field->readonly();
                        }
                    })
                    ->creationRules(['required', "unique:{$this->model}"])
                    ->updateRules(['required', "unique:{$this->model},slug,{{id}}"]);
            });
        });

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function authorization(Request $request, $id)
    {
        try {
            $permissions = array_filter($request->get('permissions'), function($value) {
                return $value !== null;
            });

            $this->model::findOrFail($id)->permissions()->sync($permissions);

            return $this->response()->success('successful！')->refresh()->send();
        } catch (Exception $exception) {
            return $this->response()->error("failed！: {$exception->getMessage()}")->send();
        }
    }
}
