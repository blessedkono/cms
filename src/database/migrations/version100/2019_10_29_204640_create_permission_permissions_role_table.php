<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionPermissionsRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->smallInteger('permission_id');
            $table->smallInteger('role_id');
            $table->timestamps();
            $table->unique(['permission_id','role_id']);
        });

        Schema::table('permission_role', function(Blueprint $table)
        {
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_permissions_role');
    }
}
