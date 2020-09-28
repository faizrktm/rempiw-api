<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->char('nopol', 50);
            $table->bigInteger('tarif');
            $table->date('mulai_tagihan');
            $table->date('akhir_tagihan');
            $table->tinyInteger('bulan');
            $table->bigInteger('jumlah');
            $table->string('keterangan', 255);
            $table->timestamps();

            // relations
            $table->unsignedInteger('invoice_id')->length(10);
            $table->foreign('invoice_id')
            ->references('id')->on('invoices')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
