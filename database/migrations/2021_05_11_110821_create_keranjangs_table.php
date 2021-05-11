<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->string("row_total")->nullable();
            $table->string("quantity")->nullable();
            $table->enum("status", ["process", "dikirim", "terkirim", "selesai", "on hold"])->nullable();
            // Relationship one to many
            $table->unsignedBigInteger("prod_id");
            $table->foreign("prod_id")->references("id")->on("products")->onDelete('cascade');
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
        Schema::dropIfExists('keranjangs');
    }
}
