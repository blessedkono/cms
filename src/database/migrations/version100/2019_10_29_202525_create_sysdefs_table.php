<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysdefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sysdefs', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->string('name', 100)->unique();
            $table->string('display_name', 100)->unique();
            $table->text('value')->nullable();
            $table->string('data_type', 20);
            $table->string('reference', 10)->unique();
            $table->smallInteger('isactive')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->smallInteger('sysdef_group_id');
        });

        Schema::table('sysdefs', function(Blueprint $table)
        {
            $table->foreign('sysdef_group_id')->references('id')->on('sysdef_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sysdefs');
    }
}
