<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat_customers', function (Blueprint $table) {
            $table->id();
            $table->string("desa");
            $table->string("kecamatan");
            $table->string("rt");
            $table->string("rw");
            $table->string("kode_pos");
            $table->string("alamat");
            $table->enum("status", ["alamat_utama", "alamat_toko", "alamat_pengembalian"]);

            // Relationship one to many
            $table->unsignedBigInteger("province_id");
            $table->foreign("province_id")->references("id")->on("provinces")->onDelete('cascade');
            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities")->onDelete('cascade');         
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
        Schema::dropIfExists('alamat_customers');
    }
}
