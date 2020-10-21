<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionPermissions2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->integer('permission_group_id')->nullable();
            $table->string('name', 150);
            $table->text('display_name');
            $table->text('description')->nullable();
            $table->smallInteger('ischecker')->default(0)->comment('set whether this permission needs a second person check ');
            $table->smallInteger('isadmin')->default(0)->comment('specify whether the role is for administration i.e. 1 is administrative, 0 not');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('permissions', function(Blueprint $table)
        {
            $table->foreign('permission_group_id')->references('id')->on('permission_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_permissions_2');
    }
}
