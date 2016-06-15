<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRookiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rookies', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('name');
            $table->integer('year');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_rookie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rookies');

        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_rookie');
        });
    }
}
