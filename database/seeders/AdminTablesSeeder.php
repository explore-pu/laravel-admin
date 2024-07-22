<?php

namespace Database\Seeders;

use Elegant\Utils\Models\Administrator;
use Elegant\Utils\Models\Menu;
use Elegant\Utils\Models\MenuGroup;
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
        $administrator_table = config('elegant-utils.admin.database.administrator_table');

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
                'group' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Home',
                'icon' => 'fas fa-tachometer-alt',
                'uri' => '/',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'group' => 1,
                'parent_id' => 0,
                'order' => 2,
                'title' => Str::singular(ucfirst($administrator_table)),
                'icon' => 'fas fa-users',
                'uri' => $administrator_table,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'group' => 1,
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Menu Groups',
                'icon' => 'fas fa-bars',
                'uri' => 'menu_groups',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'group' => 1,
                'parent_id' => 0,
                'order' => 4,
                'title' => 'Menus',
                'icon' => 'fas fa-bars',
                'uri' => 'menus',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);


        // create a menu_group.
        MenuGroup::query()->truncate();
        MenuGroup::query()->create([
            'name' => 'DEFAULT',
        ]);
    }
}
