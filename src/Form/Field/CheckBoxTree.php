<?php

namespace Elegance\Admin\Form\Field;

class CheckBoxTree extends Checkbox
{
    protected $view = 'admin::form.checkboxTree';

    /**
     * @var array
     */
    protected $relatedField = [];

    /**
     * @param string $related
     * @param string $field
     * @return $this
     */
    public function related($related, $field): CheckBoxTree
    {
        $this->relatedField = [$related, $field];

        return $this;
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        if ($this->options instanceof \Closure) {
            if ($this->form) {
                $this->options = $this->options->bindTo($this->form->model());
            }

            $this->options(call_user_func($this->options, $this->value, $this));
        }

        return $this->options;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     * @throws \ReflectionException
     * @throws \Throwable
     */
    public function render()
    {
        $this->addVariables([
            'column'       => $this->column,
            'checked'       => $this->checked,
            'inline'        => $this->inline,
            'options'       => $this->getOptions(),
            'relatedField'  => json_encode($this->relatedField),
        ]);

        return parent::fieldRender();
    }
}
