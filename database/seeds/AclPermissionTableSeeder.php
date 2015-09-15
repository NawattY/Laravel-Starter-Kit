<?php

use Illuminate\Database\Seeder;

class AclPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acl_permissions')->insert([
            'permission_title' => 'Create User',
            'permission_slug' => 'create-user',
            'permission_description' => 'Create User',
        ]);

        DB::table('acl_permissions')->insert([
            'permission_title' => 'View User',
            'permission_slug' => 'view-user',
            'permission_description' => 'view User',
        ]);

        DB::table('acl_permissions')->insert([
            'permission_title' => 'Update User',
            'permission_slug' => 'update-user',
            'permission_description' => 'Update User',
        ]);

        DB::table('acl_permissions')->insert([
            'permission_title' => 'Suspend User',
            'permission_slug' => 'suspend-user',
            'permission_description' => 'Suspend User',
        ]);
    }
}
