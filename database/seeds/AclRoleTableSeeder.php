<?php

use Illuminate\Database\Seeder;

class AclRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            'role_title' => 'Root User',
            'role_slug' => 'root_user',
        ]);

        DB::table('roles')->insert([
            'role_title' => 'Administrator',
            'role_slug' => 'administrator',
        ]);

        DB::table('roles')->insert([
            'role_title' => 'Moderator',
            'role_slug' => 'moderator',
        ]);

        DB::table('roles')->insert([
            'role_title' => 'Editor',
            'role_slug' => 'editor',
        ]);
    }
}
