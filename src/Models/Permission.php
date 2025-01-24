<?php

namespace Elegance\Admin\Models;

use Closure;
use Elegance\Admin\Traits\DefaultDatetimeFormat;
use Elegance\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    use SoftDeletes;
    use DefaultDatetimeFormat;
    use ModelTree {
        ModelTree::boot as treeBoot;
    }

    protected $fillable = [
        'parent_id',
        'type',
        'title',
        'icon',
        'method',
        'uri',
        'host',
        'order',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.permission_table'));

        parent::__construct($attributes);
    }


    /**
     * @param bool $trash
     * @return array
     */
    public function allNodes(bool $trash = false): array
    {
        $titleColumn = $this->getTitleColumn();

        $orderColumn = DB::getQueryGrammar()->wrap($this->getOrderColumn());

        $byOrder = 'ROOT ASC,'.$orderColumn;

        $query = $trash ? static::withTrashed() : static::query();

        return $query->selectRaw('*, '.$orderColumn.' as ROOT, ' . $titleColumn . ' as text')->orderByRaw($byOrder)->get()->toArray();
    }

    /**
     * @param Closure|null $closure
     * @param $rootText
     * @return array
     */
    public static function selectOptions(Closure $closure = null, $rootText = 'ROOT')
    {
        $self = new self();

        $nodes = array_filter($self->allNodes(), function ($node) {
            return in_array($node['type'], [1, 2]);
        });

        $options = $self->withQuery($closure)->buildSelectOptions($nodes);

        return collect($options)->prepend($rootText, 0)->all();
    }

    /**
     * Detach models from the relationship.
     *
     * @return void
     */
    protected static function boot()
    {
        static::treeBoot();
    }
}
