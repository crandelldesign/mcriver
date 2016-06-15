<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug');
            $table->text('description');
            $table->integer('display_order');
            $table->boolean('is_no_sizes');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->string('slug');
            $table->text('description');
            $table->integer('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('display_order');
            $table->dropColumn('is_no_sizes');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('display_order');
        });
    }
}
