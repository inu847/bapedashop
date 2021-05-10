<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Zua',
            'nama_toko' => 'zua',
            'phone' => '089601351252',
            'email' => 'zua@gmail.com',
            'status' => 'active',
            'password' =>  \Hash::make("Semogaberkah"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
