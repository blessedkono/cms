<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->index();
            $table->bigInteger('role_id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['user_id','role_id']);
        });

        Schema::table('role_user', function(Blueprint $table)
        {
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
