<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class CreatePatientsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('patients', function (Blueprint $table) {
         $table->increments('id');

         $table->integer('admin_id')->unsigned()->nullable();
         $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

         $table->integer('user_id')->unsigned()->nullable();
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

         $table->integer('last_update_user_id')->unsigned()->nullable();
         $table->foreign('last_update_user_id')->references('id')->on('users')->onDelete('cascade');

         $table->date('record_date')->nullable();
         $table->integer('f_number')->nullable();
         $table->string('civil');
         $table->string('first_name');
         $table->string('father_name');
         $table->string('grand_name');
         $table->string('title');
         $table->integer('nationality')->unsigned()->nullable();
         $table->foreign('nationality')->references('id')->on('nationalities')->onDelete('cascade');

         $table->integer('relation_id')->unsigned()->nullable();
         $table->foreign('relation_id')->references('id')->on('relationships')->onDelete('cascade');
         $table->enum('gender', ['male', 'female']);

         $table->date('date_birh_hijri');
         $table->integer('age')->nullable();
         $table->string('mobile');
         $table->string('phone')->nullable();
         $table->longtext('mobile_nearby')->nullable();
         $table->longtext('comments')->nullable();

         $table->longtext('purpose_visit')->nullable();
         $table->enum('teeth_medicine', ['yes', 'no'])->nullable();
         $table->enum('heart_disease', ['yes', 'no'])->nullable();
         $table->enum('high_low_blood', ['yes', 'no'])->nullable();
         $table->enum('rheumatic_fever', ['yes', 'no'])->nullable();
         $table->enum('anemia', ['yes', 'no'])->nullable();
         $table->enum('thyroid_disease', ['yes', 'no'])->nullable();
         $table->enum('hepatitis', ['yes', 'no'])->nullable();
         $table->enum('diabetes', ['yes', 'no'])->nullable();
         $table->enum('kidney_disease', ['yes', 'no'])->nullable();
         $table->enum('tics', ['yes', 'no'])->nullable();
         $table->enum('asthma', ['yes', 'no'])->nullable();
         $table->longtext('other_diseases')->nullable();
         $table->enum('sensitivity_penicillin', ['yes', 'no'])->nullable();
         $table->enum('taking_drugs', ['yes', 'no'])->nullable();
         $table->longtext('drugs_names')->nullable();
         $table->enum('pregnant', ['yes', 'no'])->nullable();
         $table->date('last_update_at')->nullable();

         $table->integer('dep_id')->unsigned()->nullable();
         $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');
         $table->softDeletes();
         $table->timestamps();
      });
   }

   /*
   ALTER TABLE `appoints` ADD `dep_id` INT UNSIGNED NULL DEFAULT NULL AFTER `admin_id`;
   ALTER TABLE `users` ADD `dep_id` INT UNSIGNED NULL DEFAULT NULL AFTER `id`;

    */

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('patients');
   }
}
