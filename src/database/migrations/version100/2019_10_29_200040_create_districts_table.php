<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->smallInteger('region_id');
            $table->string('name', 150);
            $table->smallInteger('isactive')->default(1);
            $table->timestamps();
        });

        Schema::table('districts', function(Blueprint $table)
        {
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
