<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class CreateDiagnosTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('diagnos', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('admin_id')->unsigned()->nullable();
         $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
         $table->integer('appoint_id')->unsigned();
         $table->foreign('appoint_id')->references('id')->on('appoints')->onDelete('cascade');
         $table->integer('patient_id')->unsigned();
         $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
         $table->integer('dr_id')->unsigned();
         $table->foreign('dr_id')->references('id')->on('users')->onDelete('cascade');
         $table->longtext('treatment')->nullable();
         $table->longtext('tooth')->nullable();
         $table->time('in_time');
         $table->date('in_day')->nullable();
         $table->longtext('taken')->nullable();
         $table->enum('period', ['morning']);
         $table->integer('group_id')->unsigned();
         $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
      Schema::dropIfExists('diagnos');
   }
}
