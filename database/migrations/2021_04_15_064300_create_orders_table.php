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
            $table->string("row_total");
            $table->string("quantity");
            // Relationship one to many
            $table->unsignedBigInteger("prod_id");
            $table->foreign("prod_id")->references("id")->on("products")->onDelete('cascade');
            $table->unsignedBigInteger("buyer_id");
            $table->foreign("buyer_id")->references("id")->on("buyers")->onDelete('cascade');
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
