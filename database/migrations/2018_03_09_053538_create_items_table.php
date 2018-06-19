<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('items')) {
			Schema::create('items', function(Blueprint $table)
			{
				$table->timestamps();
				$table->increments('id');
				$table->string('name');
				$table->string('short_name');
				$table->float('price');
				$table->boolean('is_one_size');
				$table->integer('parent_id');
				$table->integer('category_id');
				$table->string('slug');
				$table->text('description', 65535);
				$table->integer('display_order');
				$table->softDeletes();
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
		Schema::dropIfExists('items');
	}

}
