<?php

use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("nama_product");
            $table->string("deskripsi");
            // product images
            $table->string("images1");
            $table->string("images2")->nullable();
            $table->string("images3")->nullable();
            $table->string("images4")->nullable();

            $table->string("price");
            $table->enum("status", ["publish", "archive"]);
            // Relationship one to many
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('products');
    }
}
