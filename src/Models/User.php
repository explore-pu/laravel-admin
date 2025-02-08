<?php

namespace Elegance\Admin\Models;

use Elegance\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;

/**
 * Class Administrator.
 */
class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use SoftDeletes;
    use DefaultDatetimeFormat;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
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

        $this->setTable(config('admin.database.user_table'));

        parent::__construct($attributes);
    }

    /**
     * Current user roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $roleModel = config('admin.database.role_model');
        $table = config('admin.database.user_role_relational.table');
        $user_id = config('admin.database.user_role_relational.user_id');
        $role_id = config('admin.database.user_role_relational.role_id');

        return $this->belongsToMany($roleModel, $table, $user_id, $role_id)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        $permissionModel = config('admin.database.permission_model');
        $table = config('admin.database.user_permission_relational.table');
        $user_id = config('admin.database.user_permission_relational.user_id');
        $permission_id = config('admin.database.user_permission_relational.permission_id');

        return $this->belongsToMany($permissionModel, $table, $user_id, $permission_id)->withTimestamps();
    }

    /**
     * @return Builder|BelongsToMany
     */
    public function rolePermissions()
    {
        return $this->roles()->with('permissions');
    }

    /**
     * @return array
     */
    public function allPermissions()
    {
        return $this->rolePermissions->pluck('permissions')->merge($this->permissions)->flatten(1)->unique(function ($permission) {return $permission->id;});
    }

    /**
     * Determine whether it is an administrator
     *
     * @return bool
     */
    public function isAdministrator():bool
    {
        return $this->roles->where('slug', 'administrator')->isNotEmpty();
    }

    /**
     * Get avatar attribute.
     *
     * @param string $avatar
     *
     * @return string
     */
    public function getAvatarAttribute($avatar)
    {
        if (url()->isValidUrl($avatar)) {
            return $avatar;
        }

        $disk = config('admin.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk($disk)->url($avatar);
        }

        $default = config('admin.default_avatar') ?: '/vendor/laravel-admin/img/user2-160x160.jpg';

        return admin_asset($default);
    }

    /**
     * If User can see menu item.
     */
    public function menus()
    {
        if ($this->isAdministrator()) {
            $permissionModel = config('admin.database.permission_model');
            $permissions = $permissionModel::query()->where('type', 1)->get();
        } else {
            $permissions = $this->allPermissions()->filter(function ($permission) {
                return $permission->type === 1;
            });
        }

        return build_tree($permissions->toArray());
    }

    /**
     * If user can access route.
     *
     * @param Route $route
     * @return bool
     */
    public function canAccessRoute(Route $route)
    {
        if ($this->isAdministrator()) {
            return true;
        }

        $uri = $route->uri();
        $methods = $route->methods();

        return $this->allPermissions()->filter(function ($permission) use ($uri, $methods) {
            if ($permission->uri !== '/') {
                $permission->uri = ltrim($permission->uri, '/');
            }

            return in_array($permission->method, $methods) && $permission->uri === $uri;
        })->isNotEmpty();
    }
}
