<?php

namespace Elegant\Utils\Models;

use Elegant\Utils\Traits\DefaultDatetimeFormat;
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
class MenuGroup extends Model
{
    use SoftDeletes;
    use DefaultDatetimeFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.menu_groups_table'));

        parent::__construct($attributes);
    }

    public static function selectOptions()
    {
        return self::query()->pluck('name', 'id')->toArray();
    }
}
