<?php

namespace Elegance\Admin\Actions;

use Illuminate\Http\Request;

abstract class BatchAction extends TableAction
{
    /**
     * @var string
     */
    public $selectorPrefix = '.table-batch-action-';

    /**
     * {@inheritdoc}
     */
    public function actionScript()
    {
        $warning = __('No data selected!');

        return <<<SCRIPT
var key = $.admin.table.selected();
    if (key.length === 0) {
        $.admin.toastr.warning('{$warning}');
        return ;
    }
    Object.assign(data, {_key:key});
SCRIPT;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function retrieveModel(Request $request)
    {
        if (!$key = $request->get('_key')) {
            return false;
        }

        $modelClass = str_replace('_', '\\', $request->get('_model'));

        if (is_string($key)) {
            $key = explode(',', $key);
        }

        if ($this->modelUseSoftDeletes($modelClass)) {
            return $modelClass::withTrashed()->findOrFail($key);
        }

        return $modelClass::findOrFail($key);
    }

    /**
     * @return string
     */
    public function getElementClass()
    {
        return ltrim($this->selector($this->selectorPrefix), '.').' dropdown-item';
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addScript();

        $modalId = '';

        if ($this->interactor instanceof Interactor\Form) {
            $modalId = $this->interactor->getModalId();

            if ($content = $this->html()) {
                return $this->interactor->addElementAttr($content, $this->selector);
            }
        }

        return sprintf(
            "<a href='javascript:void(0);' class='%s' %s>%s</a>",
            $this->getElementClass(),
            $modalId ? "modal='{$modalId}'" : '',
            $this->name()
        );
    }
}
