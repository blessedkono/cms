<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('tin')->nullable();
            $table->string('phone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('box_no')->nullable();
            $table->string('address')->nullable();
            $table->integer('region_id')->nullable();
            $table->text('contact_person')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->smallInteger('iscompany')->default(1)->comment('Flag to specify if client is company or individual i.e. 1 => company, 0 => individual');
            $table->text('note')->nullable()->comment('Description of the supplier');
            $table->timestamps();
        });

        Schema::table('clients', function(Blueprint $table)
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
        Schema::dropIfExists('clients');
    }
}
