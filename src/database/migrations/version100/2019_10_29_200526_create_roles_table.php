<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->string('name', 191);
            $table->text('description')->nullable();
            $table->smallInteger('isactive')->default(1)->comment('specify whether the role is for active i.e. 1 is active, 0 no active');
            $table->smallInteger('isadmin')->default(0)->comment('specify whether the role is for administration i.e. 1 is administrative, 0 not');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
