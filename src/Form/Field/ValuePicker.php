<?php

namespace Elegance\Admin\Form\Field;

use Elegance\Admin\Admin;
use Elegance\Admin\Form\Field;
use Illuminate\Support\Arr;

class ValuePicker
{
    /**
     * @var string
     */
    public $modal;

    /**
     * @var Text|File
     */
    protected $field;

    /**
     * @var string
     */
    protected $column;

    /**
     * @var string
     */
    protected $selecteable;

    /**
     * @var string
     */
    protected $separator;

    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * ValuePicker constructor.
     *
     * @param string $selecteable
     * @param string $column
     * @param bool   $multiple
     * @param string $separator
     */
    public function __construct($selecteable, $column = '', $multiple = false, $separator = ';')
    {
        $this->selecteable = $selecteable;
        $this->column = $column;
        $this->multiple = $multiple;
        $this->separator = $separator;
    }

    /**
     * @param int $multiple
     *
     * @return string
     */
    protected function getLoadUrl()
    {
        $selectable = str_replace('\\', '_', $this->selecteable);

        $args = [$this->multiple, $this->column];

        return route('handle_selectable', compact('selectable', 'args'));
    }

    /**
     * @param Field $field
     */
    public function mount(Field $field)
    {
        $this->field = $field;
        $this->modal = sprintf('picker-modal-%s', $field->getElementClassString());

        Admin::view('admin::components.filepicker', [
            'url'       => $this->getLoadUrl(),
            'modal'     => $this->modal,
            'selector'  => $this->field->getElementClassSelector(),
            'separator' => $this->separator,
            'multiple'  => $this->multiple,
            'is_file'   => $this->field instanceof File,
            'is_image'  => $this->field instanceof Image,
            'url_tpl'   => $this->field instanceof File ? $this->field->objectUrl('__URL__') : '',
        ]);
    }

    /**
     * @param string $field
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function getPreview(string $field)
    {
        if (empty($value = $this->field->value())) {
            return [];
        }

        if ($this->multiple) {
            $value = explode($this->separator, $value);
        }

        return collect(Arr::wrap($value))->map(function ($item) use ($field) {
            return [
                'url'     => $this->field->objectUrl($item),
                'value'   => $item,
                'is_file' => $field == File::class,
            ];
        });
    }
}
