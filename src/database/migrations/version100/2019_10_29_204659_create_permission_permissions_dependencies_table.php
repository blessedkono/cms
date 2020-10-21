<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionPermissionsDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_dependencies', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->bigInteger('permission_id')->index();
            $table->bigInteger('dependency_id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['permission_id','dependency_id']);
        });

        Schema::table('permission_dependencies', function(Blueprint $table)
        {
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('dependency_id')->references('id')->on('permissions')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_permissions_dependencies');
    }
}
