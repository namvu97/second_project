<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user::class);
        $this->call(wallet::class);
        $this->call(category::class);
        $this->call(transaction::class);
    }
}
