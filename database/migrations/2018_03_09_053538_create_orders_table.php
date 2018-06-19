<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('orders')) {
			Schema::create('orders', function(Blueprint $table)
			{
				$table->timestamps();
				$table->increments('id');
				$table->string('email');
				$table->string('name');
				$table->integer('user_id');
				$table->integer('year');
				$table->float('total');
				$table->string('payment_method')->default('check');
				$table->boolean('is_paid')->default(0);
				$table->string('phone');
				$table->string('dish_day');
				$table->text('dish_description', 65535);
				$table->boolean('is_active')->default(1);
				$table->softDeletes();
				$table->string('friendly_order_id')->unique();
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
		Schema::dropIfExists('orders');
	}

}
