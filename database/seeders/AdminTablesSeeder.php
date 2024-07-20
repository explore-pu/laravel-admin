<?php

namespace Database\Seeders;

use Elegant\Admin\Models\Administrator;
use Elegant\Admin\Models\Menu;
use Elegant\Admin\Models\MenuGroup;
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
                'title' => 'Administrator',
                'icon' => 'fas fa-users',
                'uri' => 'administrators',
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
