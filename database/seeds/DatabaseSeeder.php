<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        $this->call(UserTableSeeder::class);
//        $this->call(AclPermissionRoleTableSeeder::class);
//        $this->call(AclPermissionTableSeeder::class);
//        $this->call(AclRoleTableSeeder::class);
//        $this->call(AclRoleUserTableSeeder::class);

        Model::reguard();
    }
}
