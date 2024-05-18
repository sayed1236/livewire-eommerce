<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesDetailsTable extends Migration {

	public function up()
	{
		Schema::create('companies_details', function(Blueprint $table) {
			$table->id();
            $table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->string('commercial_lines', 50)->nullable();
			$table->string('commercial_lines_file', 150)->nullable();
			$table->string('taxes_licenses', 50)->nullable();
			$table->string('taxes_icenses_file', 150)->nullable();
			$table->date('started_date')->nullable();
			$table->text('brief')->nullable();
            $table->enum('is_accepted',array('Y','N'))->default('N');
            // $table->enum('type', array('img', 'video'))->default('img');

			$table->string('file_of_profile',150)->nullable();
			$table->softDeletes();
			$table->timestamps();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
            $table->integer('user_added')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('companies_details');
	}
}
