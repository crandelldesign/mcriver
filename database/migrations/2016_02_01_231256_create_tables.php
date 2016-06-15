<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->string('phone');
            $table->boolean('is_admin');
            $table->boolean('is_active')->default(true);
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('email')->index();
            $table->string('token')->index();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('year');
            $table->float('total');
            $table->boolean('is_rookie');
            $table->string('payment_method')->default('check');
            $table->boolean('is_paid')->default(false);
        });

        Schema::create('items', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('name');
            $table->string('short_name');
            $table->float('price');
            $table->boolean('is_one_size');
            $table->integer('parent_id');
            $table->integer('category_id');
        });

        Schema::create('item_order', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('order_id');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('orders');
        Schema::drop('items');
        Schema::drop('item_order');
        Schema::drop('categories');
    }
}
