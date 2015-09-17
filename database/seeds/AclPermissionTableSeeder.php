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
    }
}
