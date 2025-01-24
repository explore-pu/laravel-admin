<?php

namespace Elegance\Admin\Form\Field;

use Elegance\Admin\Form\Field;
use Illuminate\Support\Arr;

class CheckTree extends Field
{
    public function prepare($value)
    {
        return array_values(array_filter(explode(',', $value)));
    }

    protected function filterChecked($tree, &$checked)
    {
        foreach ($tree as &$item) {
            if (!is_array($item)) {
                continue;
            }

            if (in_array($item['id'], $checked)
                && isset($item['children'])
                && count(array_intersect($checked, Arr::pluck($item['children'], 'id'))) > 0) {
                array_delete($checked, $item['id']);
            }

            if (isset($item['children'])) {
                $this->filterChecked($item['children'], $checked);
            }
        }
    }

    public function closeDepth($depth = 3)
    {
        return $this->addVariables('closeDepth', $depth);
    }

    public function render()
    {
        $options = $this->options;

        $checked = $this->checked;

        $this->filterChecked($options, $checked);

        $checked = array_values($checked);

        $this->addVariables(compact('options', 'checked'));

        return parent::render();
    }
}
