<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWfDefinitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wf_definition', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->index();
            $table->bigInteger('wf_definition_id')->index();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('user_wf_definition', function(Blueprint $table)
        {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('wf_definition_id')->references('id')->on('wf_definitions')->onUpdate('CASCADE')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wf_definition');
    }
}
