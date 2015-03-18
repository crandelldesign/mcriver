<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function($table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->integer('year');
			$table->string('name');
			$table->dateTime('date');
			$table->text('items');
			$table->float('total');
			$table->boolean('is_paid')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('people');
	}

}
