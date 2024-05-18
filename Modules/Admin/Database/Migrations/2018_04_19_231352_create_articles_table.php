<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->integer('ord')->default(0);
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('auther',45)->nullable();
            $table->string('img',300)->nullable();
            $table->string('url_link',300)->nullable();
            $table->string('brief',2000)->nullable();
            $table->string('brief_en',2000)->nullable();
            $table->text('details')->nullable();
            $table->text('details_en')->nullable();
            $table->string('keywords',300)->nullable();
            $table->string('description',300)->nullable();
            $table->integer('num_views')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('articles');
    }
}
