<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyDaysWorkTable extends Migration {

	public function up()
	{
		Schema::create('company_days_work', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->unsignedBigInteger('company_branche_id')->default(0)->references('id')->on('company_branches')->onDelete('CASCADE');
			$table->enum('day', array('saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'));
			$table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
			$table->softDeletes();
			$table->timestamps();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
            $table->integer('user_added')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('company_days_work');
	}
}
