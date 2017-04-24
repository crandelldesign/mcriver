<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRookiesToPersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('rookies', 'persons');
        Schema::table('persons', function ($table) {
            $table->boolean('is_active')->default(1);
            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
        });
        Schema::table('orders', function ($table) {
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function ($table) {
            $table->dropColumn('is_active');
        });
        Schema::table('persons', function ($table) {
            $table->dropColumn('is_active');
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
        Schema::rename('persons', 'rookies');

    }
}
