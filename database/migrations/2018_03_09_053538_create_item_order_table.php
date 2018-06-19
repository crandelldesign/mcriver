<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('item_order')) {
			Schema::create('item_order', function(Blueprint $table)
			{
				$table->timestamps();
				$table->increments('id');
				$table->integer('item_id');
				$table->integer('order_id');
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('item_order');
	}

}
