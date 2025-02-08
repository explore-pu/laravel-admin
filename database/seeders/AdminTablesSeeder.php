<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        $user_model = config('admin.database.user_model');
        $roles_model = config('admin.database.role_model');
        $permissions_model = config('admin.database.permission_model');

        // create a user.
        $user_model::query()->truncate();
        $user_model::query()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
        ]);

        // create a role.
        $roles_model::query()->truncate();
        $roles_model::query()->create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // add role to user.
        $user_model::query()->find(1)->roles()->sync([1]);

        // add default permissions.
        $permissions_model::query()->truncate();
        $permissions_model::query()->insert([
            [
                'parent_id' => 0,
                'type' => 1,
                'title' => 'DASHBOARD',
                'icon' => 'fas fa-tachometer-alt',
                'method' => 'GET',
                'uri' => '/',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 0,
                'type' => 1,
                'title' => 'USERS LIST',
                'icon' => 'fas fa-users',
                'method' => 'GET',
                'uri' => '/users',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 2,
                'title' => 'USERS CREATE',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/users/create',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 3,
                'type' => 3,
                'title' => 'USERS STORE',
                'icon' => 'far fa-circle',
                'method' => 'POST',
                'uri' => '/users',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 2,
                'title' => 'USERS EDIT',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/users/{user}/edit',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 5,
                'type' => 3,
                'title' => 'USERS UPDATE',
                'icon' => 'far fa-circle',
                'method' => 'PATCH',
                'uri' => '/users/{user}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 2,
                'title' => 'USERS SHOW',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/users/{user}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 3,
                'title' => 'USERS DESTROY',
                'icon' => 'far fa-circle',
                'method' => 'DELETE',
                'uri' => '/users/{user}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 3,
                'title' => 'USERS RESTORE',
                'icon' => 'far fa-circle',
                'method' => 'PUT',
                'uri' => '/users/{user}/restore',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 3,
                'title' => 'USERS DELETE',
                'icon' => 'far fa-circle',
                'method' => 'DELETE',
                'uri' => '/users/{user}/delete',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 2,
                'type' => 3,
                'title' => 'USERS AUTHORIZE',
                'icon' => 'far fa-circle',
                'method' => 'POST',
                'uri' => '/users/{user}/authorized',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 0,
                'type' => 1,
                'title' => 'ROLES LIST',
                'icon' => 'fas fa-user',
                'method' => 'GET',
                'uri' => '/roles',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 2,
                'title' => 'ROLES CREATE',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/roles/create',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 13,
                'type' => 3,
                'title' => 'ROLES STORE',
                'icon' => 'far fa-circle',
                'method' => 'POST',
                'uri' => '/roles',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 2,
                'title' => 'ROLES EDIT',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/roles/{role}/edit',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 15,
                'type' => 3,
                'title' => 'ROLES UPDATE',
                'icon' => 'far fa-circle',
                'method' => 'PATCH',
                'uri' => '/roles/{role}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 2,
                'title' => 'ROLES SHOW',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/roles/{role}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 3,
                'title' => 'ROLES DESTROY',
                'icon' => 'far fa-circle',
                'method' => 'DELETE',
                'uri' => '/roles/{role}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 3,
                'title' => 'ROLES RESTORE',
                'icon' => 'far fa-circle',
                'method' => 'PUT',
                'uri' => '/roles/{role}/restore',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 3,
                'title' => 'ROLES DELETE',
                'icon' => 'far fa-circle',
                'method' => 'DELETE',
                'uri' => '/roles/{role}/delete',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 12,
                'type' => 3,
                'title' => 'ROLES AUTHORIZE',
                'icon' => 'far fa-circle',
                'method' => 'POST',
                'uri' => '/roles/{role}/authorized',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 0,
                'type' => 1,
                'title' => 'PERMISSIONS LIST',
                'icon' => 'fas fa-ban',
                'method' => 'GET',
                'uri' => '/permissions',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 2,
                'title' => 'PERMISSIONS CREATE',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/permissions/create',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 3,
                'title' => 'PERMISSIONS STORE',
                'icon' => 'far fa-circle',
                'method' => 'POST',
                'uri' => '/permissions',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 2,
                'title' => 'PERMISSIONS EDIT',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/permissions/{permission}/edit',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 3,
                'title' => 'PERMISSIONS UPDATE',
                'icon' => 'far fa-circle',
                'method' => 'PATCH',
                'uri' => '/permissions/{permission}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 2,
                'title' => 'PERMISSIONS SHOW',
                'icon' => 'far fa-circle',
                'method' => 'GET',
                'uri' => '/permissions/{permission}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 3,
                'title' => 'PERMISSIONS DESTROY',
                'icon' => 'far fa-circle',
                'method' => 'DELETE',
                'uri' => '/permissions/{permission}',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 3,
                'title' => 'PERMISSIONS RESTORE',
                'icon' => 'far fa-circle',
                'method' => 'PUT',
                'uri' => '/permissions/{permission}/restore',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 22,
                'type' => 3,
                'title' => 'PERMISSIONS DELETE',
                'icon' => 'far fa-circle',
                'method' => 'DELETE',
                'uri' => '/permissions/{permission}/delete',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
