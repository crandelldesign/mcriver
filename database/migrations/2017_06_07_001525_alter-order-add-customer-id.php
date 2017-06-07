<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderAddCustomerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('friendly_order_id');
        });

        $orders = DB::table('orders')->get();
        foreach ($orders as $order) {
            while (true) {
                $friendly_order_id = uniqid();
                $orders_check = DB::table('orders')->where('friendly_order_id',$friendly_order_id)->first();
                if (!$orders_check){
                    DB::table('orders')->where('id', $order->id)->update(['friendly_order_id' => $friendly_order_id]);
                    break;
                }
            }
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->unique('friendly_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('friendly_order_id');
        });
    }
}
