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
			$table->boolean('is_rookie')->default(false);
			$table->string('payment_method')->default('check');
			$table->boolean('is_paid')->default(false);
		});

		Schema::create('users', function($table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->string('username')->unique();;
			$table->string('password');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->boolean('is_admin')->default(false);
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('people');
		Schema::dropIfExists('users');
	}

}
