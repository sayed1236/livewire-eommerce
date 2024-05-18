<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('seo')->default(0);
            $table->enum('lang',['Y','N'])->default('Y');
            $table->string('color')->nullable();
            $table->string('second_color')->nullable();
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
        Schema::dropIfExists('special_settings');
    }
}
