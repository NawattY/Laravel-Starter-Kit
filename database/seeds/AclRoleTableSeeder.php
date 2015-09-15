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
        DB::table('acl_roles')->insert([
            'role_title' => 'Super Admin',
            'role_slug' => 'super_admin',
        ]);

        DB::table('acl_roles')->insert([
            'role_title' => 'Moderator',
            'role_slug' => 'moderator',
        ]);

        DB::table('acl_roles')->insert([
            'role_title' => 'Editor',
            'role_slug' => 'editor',
        ]);

        DB::table('acl_roles')->insert([
            'role_title' => 'writer',
            'role_slug' => 'writer',
        ]);
    }
}
