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
            $table->string('name', 100);
            $table->string('password', 100);
            $table->string('email', 100)->unique();

            // roles: admin, user
            // is_admin -> 1,0
            // is_user -> 1,0

            $table->enum('role', ['admin', 'user'])->default('user');
            // $table->boolean('is_admin')->default(0);

            $table->string('api_token', 64)->nullable();
            $table->string('oauth_token', 255)->nullable(); //for signup with any another website

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
