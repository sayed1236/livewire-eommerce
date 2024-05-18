<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0)->references('id')->on('users')->onDelete('cascade');
            $table->string('user_key')->nullable()->unique();
            $table->enum('is_open_notifications',['Y','N'])->default('Y');
            $table->string('whatsapp',25)->nullable();
            $table->integer('balance')->default(0);
            $table->integer('user_points')->default(0);
            $table->double('years_of_experience')->default(0);
            $table->text('notes')->nullable();
            $table->enum('have_workshop',['Y','N'])->default('N');
            $table->text('notes_of_workshop')->nullable();
            $table->double('longitude')->default(0);
            $table->double('latitude')->default(0);
            $table->integer('city_id')->default(0)->references('id')->on('countries_cities');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
