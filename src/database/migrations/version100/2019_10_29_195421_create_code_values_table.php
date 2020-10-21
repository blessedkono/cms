<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_values', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->smallInteger('code_id');
            $table->string('name', 191);
            $table->string('lang', 100)->nullable()->comment('entry to facilitate language translation ');
            $table->text('description')->nullable();
            $table->string('reference', 10)->unique();
            $table->smallInteger('sort');
            $table->smallInteger('isactive')->default(1);
            $table->timestamps();
            $table->smallInteger('is_system_defined')->default(0)->comment('Flag to specify if the value is system defined or portal admin defined it i.e. 1 => system defined, 0 => portal admin defined (allow editing) ');
            $table->unique(['name','code_id']);
        });

        Schema::table('code_values', function(Blueprint $table)
        {
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
        Schema::dropIfExists('code_values');
    }
}
