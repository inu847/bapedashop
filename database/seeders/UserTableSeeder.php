<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Adi Nugroho',
            'nama_toko' => 'adishop',
            'phone' => '089601351252',
            'email' => 'adin72978@gmail.com',
            'status' => 'active',
            'password' =>  \Hash::make("Semogaberkah"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
