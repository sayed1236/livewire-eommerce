<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialsTable extends Migration {

	public function up()
	{
		Schema::create('socials', function(Blueprint $table) {
			$table->id();
			$table->string('name', 300)->nullable();
			$table->text('icon')->nullable();
			$table->text('name_url')->nullable();
            $table->timestamps();
			$table->softDeletes();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
            $table->integer('user_added')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('socials');
	}
}
