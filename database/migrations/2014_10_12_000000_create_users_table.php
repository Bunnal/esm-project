<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('employee_id')->unique();
            $table->string('username', 30);
            $table->string('email')->unique()->nullable();
            $table->string('hod_email')->nullable();
            $table->string('phone_number')->unique();
            $table->string('hod_phone')->nullable();
            $table->string('annual_leave');
            $table->date('date_joined');
            $table->string('password');
            $table->string('gender', 6);
            $table->date('dob');
            $table->bigInteger('user_department_id');
            $table->integer('position_id');
            $table->integer('user_service_grade_id');
            $table->string('status', 7)->default('enable');
            $table->string('image');
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
