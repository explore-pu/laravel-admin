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
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('admin.database.user_table'), function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('password');
            $table->softDeletes()->after('updated_at');
        });

        Schema::create(config('admin.database.role_table'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('admin.database.user_role_relational.table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('admin.database.user_role_relational.user_id'))->index();
            $table->unsignedBigInteger(config('admin.database.user_role_relational.role_id'))->index();
            $table->timestamps();
        });

        Schema::create(config('admin.database.permission_table'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0)->index();
            $table->tinyInteger('type')->default(1)->index()->comment('1:menu,2:page,3:action');
            $table->string('title', 50);
            $table->string('icon', 50)->nullable();
            $table->string('method', 50);
            $table->string('uri', 100);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('admin.database.role_permission_relational.table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('admin.database.role_permission_relational.role_id'))->index();
            $table->unsignedBigInteger(config('admin.database.role_permission_relational.permission_id'))->index();
            $table->timestamps();
        });

        Schema::create(config('admin.database.user_permission_relational.table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('admin.database.user_permission_relational.user_id'))->index();
            $table->unsignedBigInteger(config('admin.database.user_permission_relational.permission_id'))->index();
            $table->timestamps();
        });

        Schema::create(config('admin.database.log_table'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('operation');
            $table->string('method', 10);
            $table->string('path');
            $table->string('ip');
            $table->text('input');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns(config('admin.database.user_table'), ['avatar', 'deleted_at']);
        Schema::dropIfExists(config('admin.database.role_table'));
        Schema::dropIfExists(config('admin.database.user_role_relational.table'));
        Schema::dropIfExists(config('admin.database.permission_table'));
        Schema::dropIfExists(config('admin.database.role_permission_relational.table'));
        Schema::dropIfExists(config('admin.database.user_permission_relational.table'));
        Schema::dropIfExists(config('admin.database.log_table'));
    }
}
