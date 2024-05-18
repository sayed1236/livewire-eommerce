<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeCategoryTable extends Migration {

	public function up()
	{
		Schema::create('attribute_categories', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('category_id')->default(0)->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('attribute_id')->default(0)->references('id')->on('attributes')->onDelete('cascade');
            $table->timestamps();
			$table->softDeletes();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
            $table->integer('user_added')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('attribute_category');
	}
}
