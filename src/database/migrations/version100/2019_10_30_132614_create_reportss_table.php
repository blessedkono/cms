<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->string('name', 191)->unique();
            $table->string('url_name', 100)->unique();
            $table->bigInteger('report_type_id')->index();
            $table->bigInteger('report_group_id')->index();
            $table->text('description');
            $table->smallInteger('isactive')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('reports', function(Blueprint $table)
        {
            $table->foreign('report_group_id')->references('id')->on('report_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('report_type_id')->references('id')->on('report_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportss');
    }
}
