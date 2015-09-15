<?php

use Illuminate\Database\Seeder;

class AclPermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acl_permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('acl_permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 1,
        ]);
        DB::table('acl_permission_role')->insert([
            'permission_id' => 3,
            'role_id' => 1,
        ]);
        DB::table('acl_permission_role')->insert([
            'permission_id' => 4,
            'role_id' => 1,
        ]);

        DB::table('acl_permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 2,
        ]);
        DB::table('acl_permission_role')->insert([
            'permission_id' => 3,
            'role_id' => 2,
        ]);

        DB::table('acl_permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 3,
        ]);
    }
}
