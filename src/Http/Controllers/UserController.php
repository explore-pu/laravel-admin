<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Form;
use Elegance\Admin\Show;
use Elegance\Admin\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function title()
    {
        return trans('admin.users');
    }

    public function model()
    {
        return config('admin.database.user_model');
    }

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new $this->model());

        $table->model()->orderByDesc('id');

        $table->filter(function (Table\Filter $filter) {
            $filter->scope('trashed', __('admin.trashed'))->onlyTrashed();
        });

        $table->column('id', 'ID')->sortable();
        $table->column('email', trans('admin.email'));
        $table->column('name', trans('admin.name'));
        $table->column('roles', trans('admin.roles'))->pluck('name')->label();
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

            if ($actions->getKey() !== 1) {
                $actions->add(new Table\Actions\Role());
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
        $show->field('email', trans('admin.email'));
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

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });

        $form->display('id', 'ID');
        $form->text('name', trans('admin.name'))->rules('required');
        $form->email('email', trans('admin.email'))
            ->creationRules(['required', "unique:{$this->model}"])
            ->updateRules(['required', "unique:{$this->model},email,{{id}}"]);
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


    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function authorization(Request $request, $id)
    {
        try {
            $roles = array_filter($request->get('roles'), function($value) {
                return $value !== null;
            });

            $permissions = array_filter($request->get('permissions'), function($value) {
                return $value !== null;
            });

            DB::transaction(function () use ($id, $roles, $permissions) {
                $user = $this->model::findOrFail($id);
                $user->roles()->sync($roles);
                $user->permissions()->sync($permissions);
            });

            return $this->response()->success('successful！')->refresh()->send();
        } catch (\Exception $exception) {
            return $this->response()->error("failed！: {$exception->getMessage()}")->send();
        }
    }
}
