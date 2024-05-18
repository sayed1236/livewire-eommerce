<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_ms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('country',45)->nullable();
            $table->string('img',150)->nullable();
            $table->string('file',150)->nullable();
            $table->string('tel',20)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('mobile2',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('email',250)->nullable();
            $table->text('google_map')->nullable();
            $table->string('latitude',45)->nullable();
            $table->string('longitude',45)->nullable();
            $table->string('email_server',250)->nullable();
            $table->string('address',500)->nullable();
            $table->string('address_en',500)->nullable();
            $table->enum('is_active',['Y','N'])->default('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_ms');
    }
}
