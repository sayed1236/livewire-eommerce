<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type_id')->default(0);
            $table->unsignedBigInteger('role_id')->default(0);
            $table->string('member_plan',30)->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('user_name',90)->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->text('columns_need_approve')->nullable();
            $table->string('activitation_code',10)->nullable();
            $table->enum('is_connect',['Y','N'])->default('Y');
            $table->timestamp('last_connected_at')->nullable();
            $table->string('onesignal_id',500)->nullable();
            $table->double('user_balance', 8 , 2)->default(0);
            $table->string('user_lang',5)->default('ar');
            $table->integer('change_user_type')->default(0);
            $table->enum('is_active',['Y','N'])->default('Y');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('users');
    }
};
