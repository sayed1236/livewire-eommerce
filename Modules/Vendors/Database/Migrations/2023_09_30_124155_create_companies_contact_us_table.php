<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesContactUsTable extends Migration {

	public function up()
	{
		Schema::create('companies_contact_us', function(Blueprint $table) {
			$table->id();
            $table->unsignedBigInteger('company_id')->default(0)->references('id')->on('companies')->onDelete('CASCADE');
			$table->bigInteger('parent_id')->default(0);
			$table->bigInteger('user_id')->default(0);
            $table->text('message')->nullable();
			$table->timestamps();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('companies_contact_us');
	}
}
