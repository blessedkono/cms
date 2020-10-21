<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('name', 100)->unique();
            $table->integer('unit_group_id');
            $table->smallInteger('isactive')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('units', function(Blueprint $table)
        {
            $table->foreign('unit_group_id')->references('id')->on('unit_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
