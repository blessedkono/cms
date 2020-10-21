<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWfModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wf_modules', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->string('name', 191);
            $table->bigInteger('wf_module_group_id')->index();
            $table->smallInteger('isactive')->default(1);
            $table->smallInteger('type')->default(0)->comment('the different types of workflow modules for the same group. It is to be identified by types of specific resource.');
            $table->text('description')->nullable();
            $table->smallInteger('allow_repeat')->default(0)->comment('show whether for this module, a specific resource can have more than one workflow trip. 1 - Yes, 0 - No');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['wf_module_group_id','isactive','type']);
            $table->unique(['name','wf_module_group_id']);

        });

        Schema::table('wf_modules', function(Blueprint $table)
        {
            $table->foreign('wf_module_group_id')->references('id')->on('wf_module_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wf_modules');
    }
}
