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
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at', 6)->nullable();
            $table->string('password', 100);
            $table->string('phone', 50);
            $table->string('gender', 10);
            $table->date('dob');
            $table->string('address');
            $table->bigInteger('country')->unsigned();
            $table->dateTime('date_registered');
            $table->bigInteger('registered_by')->unsigned();
            $table->tinyInteger('created_via')->unsigned();
            $table->tinyInteger('logged_in')->unsigned();
            $table->tinyInteger('logged_in_via')->unsigned();
            $table->tinyInteger('active')->unsigned();
            $table->tinyInteger('blocked')->unsigned();
            $table->dateTime('date_time');
            $table->dateTime('last_login');
            $table->dateTime('last_update');
            $table->tinyInteger('admin')->unsigned();
            $table->tinyInteger('controller')->unsigned();
            $table->bigInteger('role_id')->unsigned();
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
};
