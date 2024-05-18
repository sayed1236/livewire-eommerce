<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyRatesTable extends Migration {

	public function up()
	{
		Schema::create('company_rates', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->bigInteger('user_id');
			$table->integer('rate');
			$table->text('rate_comment')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('company_rates');
	}
}
