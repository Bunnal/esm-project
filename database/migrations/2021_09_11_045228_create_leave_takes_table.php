<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_takes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('startdate');
            $table->date('enddate');
            $table->longText('reasons');
            $table->string('hand_over_job');
            $table->datetime('date_app');
            $table->string('sup_approval')->default('pending');
            $table->string('hod_approval')->default('pending');
            $table->string('hoj_approval')->default('pending');
            $table->integer('user_id');
            $table->integer('user_department_id');
            $table->integer('leave_type_id');
            $table->integer('leave_day_id');
            $table->integer('leave_numberic_id');
            $table->string("hod")->nullable();
            $table->string("sup")->nullable();
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
        Schema::dropIfExists('leave_takes');
    }
}
