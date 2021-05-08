<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_birth');
            $table->string('country');
            $table->string('nationality');
            $table->string('sex');
            $table->string('phone_number')->unique();
            $table->integer('user_type_id');
            $table->string('status');
            $table->string('email')->unique();
            $table->integer('email_verified')->default(0);
            $table->string('email_verification_token');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_img')->nullable();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
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
}
