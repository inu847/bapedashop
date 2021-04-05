<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("phone");
            $table->string("desa");
            $table->string("kecamatan");
            $table->string("rt");
            $table->string("rw");
            $table->string("kode_pos");
            $table->string("kabupaten");
            $table->string("provinsi");
            $table->string("detail_address");
            $table->enum("status", ["alamat_utama", "alamat_toko", "alamat_pengembalian"]);
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
        Schema::dropIfExists('alamat');
    }
}
