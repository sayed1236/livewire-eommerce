<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStocksTable extends Migration {

	public function up()
	{
		Schema::create('stocks', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('stock_name');
			$table->string('stock_id_num');
			$table->string('address');
			$table->string('notes');
		});
	}

	public function down()
	{
		Schema::drop('stocks');
	}
}
