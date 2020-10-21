<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWfModuleGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wf_module_groups', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->string('name', 191)->unique();
            $table->string('table_name', 100)->nullable();
                $table->smallInteger('autolocate')->default(0)->comment('specify whether the workflow group has automatic user assignment at workflow levels using wf_allocations table 1 - Yes, 0 - No');
            $table->integer('wf_group_category_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wf_module_groups');
    }
}
