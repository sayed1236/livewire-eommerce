<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
			$table->id();
			$table->string('name', 300)->unique();
			$table->string('img', 150)->nullable();
			$table->string('logo', 150)->nullable();
			$table->string('mobile', 25)->unique();
			$table->string('email', 150)->unique();
			$table->string('password', 150)->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('companies');
	}
}
