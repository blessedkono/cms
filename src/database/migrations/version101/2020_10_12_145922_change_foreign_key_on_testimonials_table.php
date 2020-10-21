<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyOnTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('testimonials', function(Blueprint $table)
        {
            $table->dropForeign('testimonials_designation_id_foreign');
        });

        Schema::table('testimonials', function(Blueprint $table)
        {
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
