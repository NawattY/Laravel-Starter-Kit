<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();

        DB::table('users')->insert([
            'first_name' => 'Laravel5',
            'last_name' => 'Core',
            'email' => 'demo@demo.com',
            'password' => bcrypt('demo'),
            'active' => 1,
        ]);
    }
}
