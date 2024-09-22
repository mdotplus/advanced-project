<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            '寿司',
            '焼肉',
            '居酒屋',
            'イタリアン',
            'ラーメン',
        ];

        foreach ($categories as $category) {
            $param = ['category' => $category];
            if (!CategoriesTableSeeder::isExist($param)) {
                DB::table('categories')->insert($param);
            }
        }
    }

    private function isExist($param)
    {
        if (
            Category::where('category', $param['category'])->first()
        ) {
            return true;
        }

        return false;
    }
}
