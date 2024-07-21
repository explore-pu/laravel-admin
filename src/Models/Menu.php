<?php

namespace Elegant\Utils\Models;

use Elegant\Utils\Traits\DefaultDatetimeFormat;
use Elegant\Utils\Traits\ModelTree;
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
class Menu extends Model
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
    protected $fillable = ['group', 'parent_id', 'order', 'title', 'icon', 'uri'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('elegant-utils.admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('elegant-utils.admin.database.menus_table'));

        parent::__construct($attributes);
    }

    /**
     * @param bool $trash
     * @return array
     */
    public function allNodes(bool $trash = false): array
    {
        $connection = config('elegant-utils.admin.database.connection') ?: config('database.default');
        $orderColumn = DB::connection($connection)->getQueryGrammar()->wrap($this->getOrderColumn());

        $byOrder = 'ROOT ASC,'.$orderColumn;

        $query = $trash ? static::withTrashed() : static::query();

        return $query->selectRaw('*, '.$orderColumn.' ROOT')->orderByRaw($byOrder)->get()->toArray();
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
