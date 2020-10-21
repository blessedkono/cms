<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->string('code', 10)->unique();
            $table->smallInteger('decimal_places')->default(2);
            $table->string('display_symbol', 10)->nullable();
            $table->string('name', 50)->unique();
            $table->smallInteger('isdefault')->default(0)->comment('check if it is the default currency, tanzanian shillings');
            $table->decimal('exch_rate')->default(0)->comment('the exchange rate to the default currency');
            $table->smallInteger('isactive')->default(1);
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
        Schema::dropIfExists('currencies');
    }
}
