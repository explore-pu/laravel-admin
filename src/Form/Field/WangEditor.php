<?php

namespace Elegance\Admin\Form\Field;

class WangEditor extends Textarea
{
    public function config(array $config)
    {
        $this->addVariables(compact('config'));

        return $this;
    }
}
