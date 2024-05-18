<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanySocialTable extends Migration {

	public function up()
	{
		Schema::create('company_social', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->unsignedBigInteger('social_id')->default(0)->references('id')->on('socials')->onDelete('CASCADE');
			$table->text('social_path')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('company_social');
	}
}
