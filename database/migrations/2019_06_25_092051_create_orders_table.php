<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->date('date');
			$table->text('status');
			$table->date('del_date');
			$table->float('price', 8,2);
			$table->string('first_name');
			$table->string('last_name');
			$table->text('address');
			$table->text('state');
			$table->integer('zip');
			$table->unsignedBigInteger('user_id');
			
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
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
