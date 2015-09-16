<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAclTableNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('acl_permissions', 'permissions');
        Schema::rename('acl_permission_role', 'permission_role');
        Schema::rename('acl_roles', 'roles');
        Schema::rename('acl_role_user', 'role_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('permissions', 'acl_permissions');
        Schema::rename('permission_role', 'acl_permission_role');
        Schema::rename('roles', 'acl_roles');
        Schema::rename('role_user', 'acl_role_user');
    }
}
