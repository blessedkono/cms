<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidOnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('categories', function (Blueprint $table) {
            $table->string('uuid');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('uuid');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->string('uuid');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('uuid');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('uuid');
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
