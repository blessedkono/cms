<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWfDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wf_definitions', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->decimal('level', 4);
            $table->bigInteger('unit_id')->index();
            $table->bigInteger('designation_id')->index();
            $table->text('description')->nullable();
            $table->text('msg_next')->nullable();
            $table->bigInteger('wf_module_id')->index();
            $table->smallInteger('active')->default(1);
            $table->bigInteger('allow_rejection')->nullable()->default(1);
            $table->smallInteger('allow_repeat_participate')->default(0);
            $table->smallInteger('is_approval')->nullable()->default(0);
            $table->smallInteger('has_next_start_optional')->default(0)->comment('Show whether the next level is optional. Help to enable user to decide whether the next level should be chosen is preferred of not');
            $table->smallInteger('is_optional')->default(0)->comment('show whether this level optional and can be skipped');
            $table->smallInteger('has_note')->default(0)->comment('this is for approval workflows, indicate whether a level should display a summary statement for the approving personnel to review for decision making');
            $table->smallInteger('isselective')->default(0)->comment('show whether this level can choose the next level to jump or not. 1 - Yes, 0 - No');
            $table->smallInteger('selective')->default(0)->comment('show whether this level can be chosen as the next level to jump or not. 1 - Yes, 0 - No');
            $table->string('action_description')->comment('Designated action for specific level')->nullable();
            $table->smallInteger('current_position_pointer')->comment('Current position pointer for wf round robin')->nullable();
         $table->timestamps();
            $table->softDeletes();
            $table->unique(['level','wf_module_id']);
        });


        Schema::table('wf_definitions', function(Blueprint $table)
        {
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('wf_module_id')->references('id')->on('wf_modules')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wf_definitions');
    }
}
