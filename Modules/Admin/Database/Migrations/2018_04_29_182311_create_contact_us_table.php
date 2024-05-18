<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->integer('admin_view')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile',25)->nullable();
            $table->string('tel',25)->nullable();
            $table->string('fax',25)->nullable();
            $table->string('subject',150)->nullable();
            $table->text('massage')->nullable();
            $table->string('file',300)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('user_ip',45)->nullable();
            $table->string('user_pc_info',500)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
