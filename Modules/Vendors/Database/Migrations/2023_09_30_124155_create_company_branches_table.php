<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyBranchesTable extends Migration {

	public function up()
	{
		Schema::create('company_branches', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->text('name')->nullable();
			$table->string('mobile', 25)->nullable();
			$table->text('address')->nullable();
			$table->string('email', 150)->nullable();
			$table->softDeletes();
			$table->timestamps();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
            $table->integer('user_added')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('company_branches');
	}
}
