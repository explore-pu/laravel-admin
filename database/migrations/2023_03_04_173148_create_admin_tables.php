<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('elegant-utils.admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('elegant-utils.admin.database.administrator_table'), function (Blueprint $table) {
            $table->id();
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(config('elegant-utils.admin.database.menus_table'), function (Blueprint $table) {
            $table->id();
            $table->integer('group')->default(1);
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(config('elegant-utils.admin.database.menu_groups_table'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('elegant-utils.admin.database.administrator_table'));
        Schema::dropIfExists(config('elegant-utils.admin.database.menus_table'));
        Schema::dropIfExists(config('elegant-utils.admin.database.menu_groups_table'));
    }
}
