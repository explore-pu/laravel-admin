<?php

namespace Elegance\Admin\Models;

use Elegance\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    use DefaultDatetimeFormat;

    protected $fillable = [
        'name',
        'slug',
        'data_power',
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

        $this->setTable(config('admin.database.role_table'));

        parent::__construct($attributes);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        $userModel = config('admin.database.user_model');
        $table = config('admin.database.user_role_relational.table');
        $role_id = config('admin.database.user_role_relational.role_id');
        $user_id = config('admin.database.user_role_relational.user_id');

        return $this->belongsToMany($userModel, $table, $role_id, $user_id)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        $permissionModel = config('admin.database.permission_model');
        $table = config('admin.database.role_permission_relational.table');
        $role_id = config('admin.database.role_permission_relational.role_id');
        $permission_id = config('admin.database.role_permission_relational.permission_id');

        return $this->belongsToMany($permissionModel, $table, $role_id, $permission_id)->withTimestamps();
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($model) {
            if (!method_exists($model, 'trashed') || $model->trashed()) {
                $model->users()->detach();
                $model->permissions()->detach();
            }
        });
    }
}
