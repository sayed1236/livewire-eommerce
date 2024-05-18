<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type',15)->default(0);
            $table->unsignedBigInteger('parent_id')->default(0)->references('id')->on('categories')->onDelete('cascade');
            //$table->integer('parent_id');
            $table->integer('ord')->default(0);
            $table->string('name')->nullable();
            $table->string('img',150)->nullable();
            $table->string('img_thumbnail',150)->nullable();
            $table->string('img_nave',150)->nullable();
            $table->integer('num_views')->default(0);
            $table->enum('choose_viewd',['Y','N'])->default('N')->nullable();
            $table->text('details')->nullable();
            $table->text('details_en')->nullable();
            $table->enum('is_active',['Y','N'])->default('Y');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
            $table->integer('user_added')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
