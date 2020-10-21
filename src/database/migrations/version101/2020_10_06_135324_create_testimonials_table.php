<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('client_id');
            $table->smallInteger('designation_id')->nullable();
            $table->string('company_name')->nullable();
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('testimonials', function(Blueprint $table)
        {
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('designation_id')->references('id')->on('clients')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonials');
    }
}
