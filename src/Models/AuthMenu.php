<?php

namespace Elegance\Admin\Models;

use Elegance\Admin\Traits\DefaultDatetimeFormat;
use Elegance\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Menu.
 *
 * @property int $id
 *
 * @method where($parent_id, $id)
 */
class AuthMenu extends Model
{
    use SoftDeletes;
    use DefaultDatetimeFormat;
    use ModelTree {
            ModelTree::boot as treeBoot;
        }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'order', 'title', 'icon', 'uri'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.menu_table'));

        parent::__construct($attributes);
    }

    /**
     * @param bool $trash
     * @return array
     */
    public function allNodes(bool $trash = false): array
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $titleColumn = $this->getTitleColumn();
        $orderColumn = DB::connection($connection)->getQueryGrammar()->wrap($this->getOrderColumn());

        $byOrder = 'ROOT ASC,'.$orderColumn;

        $query = $trash ? static::withTrashed() : static::query();

        return $query->selectRaw('*, '.$orderColumn.' as ROOT, ' . $titleColumn . ' as text')->orderByRaw($byOrder)->get()->toArray();
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
