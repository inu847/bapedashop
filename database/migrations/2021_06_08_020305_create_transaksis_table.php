<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string("status_message");
            $table->string("transaction_id");
            $table->string("gross_amount");
            $table->string("payment_type");
            $table->string("transaction_status");
            $table->string("bank");
            $table->string("va_number");
            $table->string("fraud_status");
            $table->string("pdf_url");
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("keranjangs")->onDelete("cascade");
            $table->unsignedBigInteger("customer_id");
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete('cascade');
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
        Schema::dropIfExists('transaksis');
    }
}
