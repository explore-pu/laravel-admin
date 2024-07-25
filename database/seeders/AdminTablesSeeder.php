<?php

namespace Database\Seeders;

use Elegant\Utils\Models\Administrator;
use Elegant\Utils\Models\Menu;
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
        Administrator::query()->truncate();
        Administrator::query()->create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
        ]);

        // add default menus.
        Menu::query()->truncate();
        Menu::query()->insert([
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
                'title' => 'Adminstrator',
                'icon' => 'fas fa-users',
                'uri' => 'auth-users',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Menus',
                'icon' => 'fas fa-bars',
                'uri' => 'menus',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
