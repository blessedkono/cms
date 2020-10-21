<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->string('name', 191)->unique();
            $table->smallInteger('country_id')->index();
            $table->timestamps();
            $table->string('hasc', 8)->nullable();
            $table->smallInteger('isactive')->default(1);
        });

        Schema::table('regions', function(Blueprint $table)
        {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
