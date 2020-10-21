<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWfGroupCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wf_group_categories', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->string('name', 191)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('wf_module_groups', function(Blueprint $table)
        {
            $table->foreign('wf_group_category_id')->references('id')->on('wf_group_categories')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_wf_group_categories');
    }
}
