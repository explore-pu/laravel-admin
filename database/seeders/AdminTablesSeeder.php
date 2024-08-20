<?php

namespace Database\Seeders;

use App\Models\AuthUser;
use App\Models\AuthMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        // create a user.
        AuthUser::query()->truncate();
        AuthUser::query()->create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
        ]);

        // add default menus.
        AuthMenu::query()->truncate();
        AuthMenu::query()->insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Home',
                'icon' => 'fas fa-tachometer-alt',
                'uri' => '/',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Users',
                'icon' => 'fas fa-users',
                'uri' => 'auth/users',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Menus',
                'icon' => 'fas fa-bars',
                'uri' => 'auth/menus',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
