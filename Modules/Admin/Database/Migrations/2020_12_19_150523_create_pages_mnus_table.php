<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesMnusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_mnus', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('ord')->default(0);
            $table->string('name',150)->nullable();
            $table->string('name_en',150)->nullable();
            $table->string('page_url',500)->nullable();
            $table->string('img',150)->nullable();
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
        Schema::dropIfExists('pages_mnus');
    }
}
