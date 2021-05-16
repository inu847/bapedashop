<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'adin72978',
            'phone' => '089601351252',
            'email' => 'admin@gmail.com',
            'status' => 'active',
            'password' =>  \Hash::make("Semogaberkah"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
