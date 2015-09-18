<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableFieldForEntrustPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function ($table) {
            $table->renameColumn('role_title', 'display_name');
            $table->renameColumn('role_slug', 'name');
            $table->text('description');
        });

        Schema::table('permissions', function ($table) {
            $table->renameColumn('permission_title', 'display_name');
            $table->renameColumn('permission_slug', 'name');
            $table->renameColumn('permission_description', 'description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function ($table) {
            $table->renameColumn('display_name', 'role_title');
            $table->renameColumn('name', 'role_slug');
            $table->dropColumn('description');
        });

        Schema::table('permissions', function ($table) {
            $table->renameColumn('display_name', 'permission_title');
            $table->renameColumn('name', 'permission_slug');
            $table->renameColumn('description', 'permission_description');
        });
    }
}
