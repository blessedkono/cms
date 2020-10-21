<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->string('name', 150);
            $table->string('lang', 150)->nullable()->comment('entry to facilitate language translation ');
            $table->smallInteger('is_system_defined')->default(1)->comment('the code defined with this will never be available for editing ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
}
