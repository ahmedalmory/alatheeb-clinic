<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('departments', function (Blueprint $table) {
         $table->increments('id');
         $table->string('dep_name');
         $table->integer('parent')->unsigned()->nullable();
         $table->foreign('parent')->references('id')->on('departments')->onDelete('cascade');
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
      Schema::dropIfExists('departments');
   }
}
