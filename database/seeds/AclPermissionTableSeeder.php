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
        DB::table('permissions')->insert([
            'permission_title' => 'Create User',
            'permission_slug' => 'user-create',
            'permission_description' => 'Create User',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'View User',
            'permission_slug' => 'user-view',
            'permission_description' => 'view User',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Update User',
            'permission_slug' => 'user-update',
            'permission_description' => 'Update User',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Suspend User',
            'permission_slug' => 'user-suspend',
            'permission_description' => 'Suspend User',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Permission Create',
            'permission_slug' => 'permission-create',
            'permission_description' => 'Permission Create',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Permission View',
            'permission_slug' => 'permission-view',
            'permission_description' => 'Permission View',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Permission Update',
            'permission_slug' => 'permission-update',
            'permission_description' => 'Permission Update',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Permission Delete',
            'permission_slug' => 'permission-suspend',
            'permission_description' => 'Permission Delete',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Role Create',
            'permission_slug' => 'role-create',
            'permission_description' => 'Role Create',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Role View',
            'permission_slug' => 'role-view',
            'permission_description' => 'Role View',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Role Update',
            'permission_slug' => 'role-update',
            'permission_description' => 'Role Update',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Role Delete',
            'permission_slug' => 'role-suspend',
            'permission_description' => 'Role Delete',
        ]);
    }
}
