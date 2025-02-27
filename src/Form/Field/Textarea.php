<?php

namespace Elegance\Admin\Form\Field;

use Elegance\Admin\Form\Field;

class Textarea extends Field
{
    use HasValuePicker;
    use CanCascadeFields;

    /**
     * Default rows of textarea.
     *
     * @var int
     */
    protected $rows = 5;

    /**
     * Set rows of textarea.
     *
     * @param int $rows
     *
     * @return $this
     */
    public function rows($rows = 5)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if (!$this->shouldRender()) {
            return '';
        }

        if (is_array($this->value)) {
            $this->value = json_encode($this->value, JSON_PRETTY_PRINT);
        }

        $this->mountPicker();

        $this->addCascadeScript();

        return parent::fieldRender([
            'picker' => $this->picker,
            'rows'   => $this->rows,
        ]);
    }
}
