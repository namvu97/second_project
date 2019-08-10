<?php
use Illuminate\Database\Seeder;

class user extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            ['id' => 1, 'username' => 'namvu97', 'password' => bcrypt('nam123'), 'email' => 'namvpn23121997@gmail.com', 'full_name' => 'Vũ Phương Nam', 'verified' => 1],
            ['id' => 2, 'username' => 'namvu9701', 'password' => bcrypt('nam123'), 'email' => 'namvp2312@gmail.com', 'full_name' => 'Nguyễn Văn A', 'verified' => 1],
            ['id' => 3, 'username' => 'namvu9702', 'password' => bcrypt('nam123'), 'email' => 'namvu9702@gmail.com', 'full_name' => 'Nguyễn Văn B', 'verified' => 1],
            ['id' => 4, 'username' => 'namvu9703', 'password' => bcrypt('nam123'), 'email' => 'namvu9704@gmail.com', 'full_name' => 'Nguyễn Văn C', 'verified' => 1],
        ]);
    }
}
