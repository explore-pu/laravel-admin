<?php

namespace Elegance\Admin\Table\Filter;

use Elegance\Admin\Admin;
use Illuminate\Support\Arr;

class Between extends AbstractFilter
{
    /**
     * {@inheritdoc}
     */
    protected $view = 'admin::table.filter.between';

    /**
     * Format id.
     *
     * @param string $column
     *
     * @return array|string
     */
    public function formatId($column)
    {
        $id = str_replace('.', '_', $column);

        return ['start' => "{$id}_start", 'end' => "{$id}_end"];
    }

    /**
     * Format two field names of this filter.
     *
     * @param string $column
     *
     * @return array
     */
    protected function formatName($column)
    {
        $columns = explode('.', $column);

        if (count($columns) == 1) {
            $name = $columns[0];
        } else {
            $name = array_shift($columns);

            foreach ($columns as $column) {
                $name .= "[$column]";
            }
        }

        return ['start' => "{$name}[start]", 'end' => "{$name}[end]"];
    }

    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function condition($inputs)
    {
        if ($this->ignore) {
            return;
        }

        if (!Arr::has($inputs, $this->column)) {
            return;
        }

        $this->value = Arr::get($inputs, $this->column);

        $value = array_filter($this->value, function ($val) {
            return $val !== '';
        });

        if (empty($value)) {
            return;
        }

        if (!isset($value['start'])) {
            return $this->buildCondition($this->column, '<=', $value['end']);
        }

        if (!isset($value['end'])) {
            return $this->buildCondition($this->column, '>=', $value['start']);
        }

        $this->query = 'whereBetween';

        return $this->buildCondition($this->column, $this->value);
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function datetime($options = [])
    {
        $this->view = 'admin::table.filter.betweenDatetime';

        $this->setupDatetime($options);

        return $this;
    }

    /**
     * @param array $options
     */
    protected function setupDatetime($options = [])
    {
        admin_assets_require('datetimepicker');

        $options['format'] = Arr::get($options, 'format', 'YYYY-MM-DD HH:mm:ss');
        $options['locale'] = Arr::get($options, 'locale', config('app.locale'));
        Arr::set($options, 'icons.time', 'fas fa-clock');

        $startOptions = json_encode($options);
        $endOptions = json_encode($options + ['useCurrent' => false]);

        $script = <<<SCRIPT
    $('#{$this->id['start']}').datetimepicker($startOptions);
    $('#{$this->id['end']}').datetimepicker($endOptions);
    $("#{$this->id['start']}").on("dp.change", function (e) {
        $('#{$this->id['end']}').data("DateTimePicker").minDate(e.date);
    });
    $("#{$this->id['end']}").on("dp.change", function (e) {
        $('#{$this->id['start']}').data("DateTimePicker").maxDate(e.date);
    });
SCRIPT;

        Admin::script($script);
    }
}
