<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class CreateAppointsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('appoints', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('admin_id')->unsigned()->nullable();
         $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
         $table->integer('patient_id')->unsigned();
         $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
         $table->enum('period', ['morning', 'evening']);
         $table->date('in_day');
         $table->string('in_time');
         $table->integer('group_id')->unsigned()->nullable();
         $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
         $table->integer('user_id')->unsigned()->nullable();
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->enum('attend_status', ['pending', 'alarm_sms', 'unattended', 'attended']);
         $table->enum('sms_sent', ['no', 'yes'])->default('no');
         $table->integer('dep_id')->unsigned()->nullable();
         $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');
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
      Schema::dropIfExists('appoints');
   }
}
