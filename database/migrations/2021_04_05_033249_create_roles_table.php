<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('file_penunjang');
            $table->string('ktp');
            // hanya admin yang bisa mengubah role
            $table->enum("role", ["trial" ,"member", "super member"]);
            $table->string("api_key")->nullable();
            $table->integer("field 1")->nullable();
            $table->integer("field 2")->nullable();
            $table->integer("field 3")->nullable();
            $table->integer("field 4")->nullable();
            $table->integer("field 5")->nullable();
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
        Schema::dropIfExists('roles');
    }
}
