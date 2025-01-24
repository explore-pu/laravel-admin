<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Form;
use Elegance\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{

    /**
     * User setting page.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function edit(Content $content)
    {
        $form = $this->settingForm();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });

        return $content
            ->title(trans('admin.user_setting'))
            ->body($form->edit(Auth::user()->id));
    }

    /**
     * Update user setting.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update()
    {
        return $this->settingForm()->update(Auth::user()->id);
    }

    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $class = config('admin.database.user_model');

        $form = new Form(new $class());

        $form->text('name', trans('admin.name'))->rules('required');
        $form->display('email', trans('admin.email'));
        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->setAction(route('setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('setting'));
        });

        return $form;
    }
}
