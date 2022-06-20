<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxAmountToInvoiceMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_main', function (Blueprint $table) {
            $table->double('tax_amount')->default(0);
            $table->text('rendered_qr_code')->nullable();
        });
        Schema::table('settings',function (Blueprint  $table){
            $table->string('tax_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_main', function (Blueprint $table) {
            $table->dropColumn('tax_amount','rendered_qr_code');
        });
        Schema::table('settings',function (Blueprint  $table){
            $table->dropColumn('tax_id');
        });
    }
}
