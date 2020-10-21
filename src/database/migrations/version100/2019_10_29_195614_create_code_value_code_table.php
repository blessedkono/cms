<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeValueCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_value_code', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->smallInteger('code_value_id');
            $table->smallInteger('code_id');
            $table->timestamps();
            $table->smallInteger('iscategory')->default(0)->comment('Flag to specify if code is subcategory of the code value; 1 => category, 0 => not category');
            $table->unique(['code_value_id','code_id']);
        });

        Schema::table('code_value_code', function(Blueprint $table)
        {
            $table->foreign('code_value_id')->references('id')->on('code_values')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('code_id')->references('id')->on('codes')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_value_code');
    }
}
