<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persons', function(Blueprint $table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->string('name');
			$table->integer('year');
			$table->boolean('is_rookie')->default(0);
			$table->boolean('is_active')->default(1);
			$table->integer('order_id')->unsigned()->nullable()->index('persons_order_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('persons');
	}

}
