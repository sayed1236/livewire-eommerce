<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyGalleryTable extends Migration {

	public function up()
	{
		Schema::create('company_gallery', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->unsignedBigInteger('company_branche_id')->default(0)->references('id')->on('company_branches')->onDelete('CASCADE');
			$table->enum('type', array('img', 'video'))->default('img');
			$table->string('path', 150)->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('company_gallery');
	}
}
