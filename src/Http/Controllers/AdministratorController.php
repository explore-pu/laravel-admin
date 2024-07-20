<?php

namespace Elegant\Utils\Http\Controllers;

use Elegant\Utils\Form;
use Elegant\Utils\Show;
use Elegant\Utils\Table;

class AdministratorController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function title()
    {
        return trans('admin.administrator');
    }

    public function model()
    {
        return config('admin.database.administrator_model');
    }

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new $this->model());

        $table->filter(function (Table\Filter $filter) {
            // 范围过滤器，调用模型的`onlyTrashed`方法，查询出被软删除的数据。
            $filter->scope('trashed', __('admin.trashed'))->onlyTrashed();

        });

        $table->column('id', 'ID')->sortable();
        $table->column('username', trans('admin.username'));
        $table->column('name', trans('admin.name'));
        $table->column('created_at', trans('admin.created_at'));
        $table->column('updated_at', trans('admin.updated_at'));

        $table->actions(function (Table\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDestroy();
            }
            if ($actions->row->deleted_at) {
                $actions->disableView();
                $actions->disableEdit();
                $actions->disableDestroy();
                $actions->add(new Table\Actions\Restore());
                $actions->add(new Table\Actions\Delete());
            }
        });

        $table->tools(function (Table\Tools $tools) {
            $tools->batch(function (Table\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });

        return $table;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show($this->model::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('username', trans('admin.username'));
        $show->field('name', trans('admin.name'));
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

        $userTable = config('admin.database.administrator_table');
        $connection = config('admin.database.connection');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });

        $form->display('id', 'ID');
        $form->text('username', trans('admin.username'))
            ->creationRules(['required', "unique:{$connection}.{$userTable}"])
            ->updateRules(['required', "unique:{$connection}.{$userTable},username,{{id}}"]);

        $form->text('name', trans('admin.name'))->rules('required');
        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore(['password_confirmation']);

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        return $form;
    }
}
