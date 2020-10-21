<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportGroupReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_group_report', function (Blueprint $table) {
            $table->smallIncrements("id");
            $table->smallInteger("report_id");
            $table->smallInteger("report_group_id");
            $table->timestamps();
        });

        Schema::table('report_group_report', function(Blueprint $table)
        {
            $table->foreign('report_id')->references('id')->on('reports')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('report_group_id')->references('id')->on('report_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_group_report');
    }
}
