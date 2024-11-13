<?php

namespace Database\Seeders;

use App\Models\Authority;
use Carbon\Carbon;
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
        $param = ['authority' => 1];
        if (!AuthoritiesTableSeeder::isExist($param)) {
            DB::table('authorities')->insert($param);
        }

        $param = ['authority' => 2];
        if (!AuthoritiesTableSeeder::isExist($param)) {
            DB::table('authorities')->insert($param);
        }

        $param = ['authority' => 3];
        if (!AuthoritiesTableSeeder::isExist($param)) {
            DB::table('authorities')->insert($param);
        }
    }

    private function isExist($param)
    {
        if (
            Authority::where('authority', $param['authority'])->first()
        ) {
            return true;
        }

        return false;
    }
}
