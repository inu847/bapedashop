<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nama_toko')->unique();
            $table->string('email')->unique();
            $table->string('profil')->nullable();
            $table->string('phone');
            $table->string('file_penunjang');
            $table->string('ktp');
            $table->enum('status', ["active", "inactive"]);
            $table->string('tanggal_lahir')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('enkripsi')->nullable();
            $table->string('enkripsi_token', 60)->unique()->nullable();
            $table->rememberToken();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['api_token']);
        });
    }
}
