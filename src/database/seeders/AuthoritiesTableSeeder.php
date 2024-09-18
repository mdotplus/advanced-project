<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthoritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'authority' => 1,
        ];
        DB::table('authors')->insert($param);
        $param = [
            'authority' => 2,
        ];
        DB::table('authors')->insert($param);
        $param = [
            'authority' => 3,
        ];
        DB::table('authors')->insert($param);
    }
}
