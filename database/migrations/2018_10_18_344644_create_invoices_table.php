<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class CreateInvoicesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('invoices', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('admin_id')->unsigned()->nullable();
         $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
         $table->integer('patient_id')->unsigned();
         $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
         $table->integer('dr_id')->unsigned()->nullable();
         $table->foreign('dr_id')->references('id')->on('users')->onDelete('cascade');
         $table->integer('accountant_id')->unsigned()->nullable();
         $table->foreign('accountant_id')->references('id')->on('users')->onDelete('cascade');
         $table->date('invoice_date');
         $table->longtext('price_list');
         $table->longtext('content');
         $table->enum('invoice_status', ['paid', 'unpaid']);
         $table->enum('pay_at', ['visa', 'cash']);
         $table->integer('dr_group_id')->unsigned()->nullable();
         $table->foreign('dr_group_id')->references('id')->on('groups')->onDelete('cascade');

         $table->integer('accountant_group_id')->unsigned()->nullable();
         $table->foreign('accountant_group_id')->references('id')->on('groups')->onDelete('cascade');

         $table->integer('appoint_id')->unsigned()->nullable();
         $table->foreign('appoint_id')->references('id')->on('appoints')->onDelete('cascade');

         $table->enum('period', ['morning', 'evening'])->nullable();
         $table->date('in_day')->nullable();
         $table->string('in_time')->nullable();
         $table->integer('dep_id')->unsigned()->nullable();
         $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');

         $table->softDeletes();
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
      Schema::dropIfExists('invoices');
   }
}
