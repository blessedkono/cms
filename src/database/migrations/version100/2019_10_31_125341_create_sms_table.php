<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->string('msisdn', 30)->comment('phone number of the portal user');
            $table->text('message');
            $table->text('status')->nullable()->comment('message returned by sms api from the service provider');
            $table->timestamps();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
