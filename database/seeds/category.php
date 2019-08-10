<?php
use Illuminate\Database\Seeder;

class category extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            ['id' => 1, 'category_name' => 'Danh mục 01', 'category_type' => 0, 'user_id' => 1],
            ['id' => 2, 'category_name' => 'Danh mục 02', 'category_type' => 1, 'user_id' => 1],
            ['id' => 3, 'category_name' => 'Danh mục 03', 'category_type' => 0, 'user_id' => 2],
            ['id' => 4, 'category_name' => 'Danh mục 04', 'category_type' => 1, 'user_id' => 2],
        ]);
    }
}
