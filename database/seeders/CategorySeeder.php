<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tạo từng bản ghi
        // DB::table('categories')-> insert([
        
        // tạo từng bản ghi (tạo thủ công)
        // 'name' => "banhday",
        // 'status' => 0,

        // tạo tự động (1 cái)
        // 'name' => fake() -> name(),
        // 'status' => fake() ->numberBetween(0,1),
        // ]);
        
        // tạo nhiều bản ghi
        // tạo mảng rỗng để chứa các bản ghi được tạo
        $cateSeed = [];
        for ($i = 0; $i < 10; $i++) {
            $cateSeed[] = [
                'name' => fake()->name(),
                'status' => fake()->numberBetween(0, 1),
            ];
        }
        DB::table('categories')->insert($cateSeed);
    }
}
