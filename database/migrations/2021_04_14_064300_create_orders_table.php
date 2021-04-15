<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("buyer");
            $table->string("product_name");
            $table->string("deskripsi");
            $table->string("price");
            $table->string("images");
            // total order
            $table->enum('status', ["on hold", "process" ,"success"]);
            $table->string("row_total");
            $table->string("quantity");
            $table->string("total_quantity");
            $table->string("subtotal");
            // Relationship one to many
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
