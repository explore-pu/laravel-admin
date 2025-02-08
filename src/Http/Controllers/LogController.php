<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class LogController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function title()
    {
        return trans('admin.operation_logs');
    }

    public function model()
    {
        return config('admin.database.log_model');
    }

    /**
     * @return Table
     */
    protected function table()
    {
        $model = $this->model;

        $table = new Table(new $model());
        $table->model()->orderByDesc('id');

        $table->filter(function (Table\Filter $filter) use ($model) {
            $filter->disableIdFilter();

            $filter->column(6, function (Table\Filter $filter) {
                $userModel = config('admin.database.user_model');
                $filter->equal('user_id', trans('admin.operator'))->select($userModel::pluck('name', 'id'));
            });

            $filter->column(6, function (Table\Filter $filter) use ($model) {
                $filter->equal('method', trans('admin.http_method'))->select(array_combine($model::$methods, $model::$methods));
            });

            $filter->column(6, function (Table\Filter $filter) {
                $filter->like('path', trans('admin.http_uri'));
            });

            $filter->column(6, function (Table\Filter $filter) {
                $filter->equal('ip', trans('admin.http_ip'));
            });
        });

        $table->column('id', 'ID')->sortable();
        $table->column('user.name', trans('admin.operator'));
        $table->column('operation', trans('admin.behave'))->display(function ($operation) {
            return implode('.', array_map(function ($item) {
                return trans('admin.' . $item);
            }, explode('.', $operation)));
        });
        $table->column('method', trans('admin.http_method'))->display(function ($method) use ($model) {
            $color = Arr::get($model::$method_colors, $method, 'grey');
            return '<span class="badge bg-' . $color . '">' . $method . '</span>';
        });
        $table->column('path', trans('admin.http_uri'))->label('info');
        $table->column('ip', trans('admin.http_ip'))->label('info');
        $table->column('input', trans('admin.input'))->display(function () {
            return trans('admin.view');
        })->modal(trans('admin.view') . trans('admin.input'), function ($modal) {
            $input = json_decode($modal->input, true);
            $input = Arr::except($input, ['_pjax', '_token', '_method', '_previous_']);
            if (empty($input)) {
                return '<pre>{}</pre>';
            }

            return '<pre>'.json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).'</pre>';
        });

        $table->column('created_at', trans('admin.created_at'));

        $table->actions(function (Table\Displayers\Actions $actions) {
            $actions->disableEdit();
            $actions->disableView();
        });

        $table->disableCreateButton();

        return $table;
    }

    /**
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);

        if ($this->model::destroy(array_filter($ids))) {
            return $this->response(false)->success(trans('admin.delete_succeeded'))->refresh()->send();
        } else {
            return $this->response(false)->error(trans('admin.delete_failed'))->send();
        }
    }
}
