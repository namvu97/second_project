<?php
use Illuminate\Database\Seeder;

class wallet extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallet')->insert([
            ['id' => 1, 'wallet_name' => 'Ví 01', 'account_number' => '0287654321', 'current_balance' => 200, 'user_id' => 1],
            ['id' => 2, 'wallet_name' => 'Ví 02', 'account_number' => '0487665346', 'current_balance' => 300, 'user_id' => 2],
            ['id' => 3, 'wallet_name' => 'Ví 03', 'account_number' => '0787684389', 'current_balance' => 400, 'user_id' => 3],
            ['id' => 4, 'wallet_name' => 'Ví 04', 'account_number' => '0487584395', 'current_balance' => 500, 'user_id' => 4],
        ]);
    }
}
