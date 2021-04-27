<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string("nama_pembeli");
            $table->string("ssid");
            $table->string("password_wifi");
            $table->string("keterangan")->nullable();
            $table->string("status");
            $table->enum("roles", ['member', 'super member']);
            // Relationship one to many
            $table->unsignedBigInteger("alamat_id");
            $table->foreign("alamat_id")->references("id")->on("alamats")->onDelete('cascade');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->dateTime("finished_at");
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
        Schema::dropIfExists('tools');
    }
}
