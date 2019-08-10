<?php
use Illuminate\Database\Seeder;

class transaction extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction')->insert([
            ['id' => 1, 'amount' => '4000', 'time' => now(), 'from_wallet' => 'A', 'to_wallet' => 'C', 'category_id' => 4],
            ['id' => 2, 'amount' => '3000', 'time' => now(), 'from_wallet' => 'A', 'to_wallet' => 'D', 'category_id' => 2],
            ['id' => 3, 'amount' => '2000', 'time' => now(), 'from_wallet' => 'B', 'to_wallet' => 'E', 'category_id' => 1],
            ['id' => 4, 'amount' => '1000', 'time' => now(), 'from_wallet' => 'B', 'to_wallet' => 'F', 'category_id' => 3],
        ]);
    }
}
