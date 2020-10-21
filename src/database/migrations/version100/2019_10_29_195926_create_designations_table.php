<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('name', 100);
            $table->string('short_name', 20)->nullable()->comment('Short name of the long designation name.');
            $table->smallInteger('isactive')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name','short_name'], 'name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
}
