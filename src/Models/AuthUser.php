<?php

namespace Elegant\Utils\Models;

use Elegant\Utils\Traits\DefaultDatetimeFormat;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;

/**
 * Class Administrator.
 */
class AuthUser extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use SoftDeletes;
    use DefaultDatetimeFormat;

    protected $fillable = [
        'username',
        'password',
        'name',
        'avatar'
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('elegant-utils.admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('elegant-utils.admin.database.user_table'));

        parent::__construct($attributes);
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

        $disk = config('elegant-utils.admin.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk($disk)->url($avatar);
        }

        $default = config('elegant-utils.admin.default_avatar') ?: '/vendor/laravel-admin/img/user2-160x160.jpg';

        return admin_asset($default);
    }

    /**
     * If User can see menu item.
     *
     * @param Menu $menu
     *
     * @return bool
     */
    public function canSeeMenu($menu)
    {
        return true;
    }

    /**
     * If user can access route.
     *
     * @param Route $route
     * @return bool
     */
    public function canAccessRoute(Route $route)
    {
        return true;
    }
}
