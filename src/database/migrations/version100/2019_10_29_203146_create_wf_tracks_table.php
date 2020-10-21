<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWfTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wf_tracks', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->nullable()->index();
            $table->smallInteger('status')->comment('status of the track, 0 - Pending for action, 1 - Recommended/Approved, 2 - Rejected to previous level, 3 - Declined/Approval Denied, 4 - Seek Advice, 5 - Cancelled by Initiator/User');
            $table->bigInteger('resource_id');
            $table->text('comments')->nullable();
            $table->smallInteger('assigned');
            $table->bigInteger('parent_id')->nullable()->index();
            $table->dateTime('receive_date')->nullable();
            $table->dateTime('forward_date')->nullable();
              $table->bigInteger('wf_definition_id')->index();
            $table->string('user_type', 150)->nullable();
            $table->smallInteger('source')->nullable()->default(1)->comment('Specify where the workflow track if from online application, 1 => Internal, 2=> Online via webbrowsers');
            $table->string('resource_type', 150)->nullable();
            $table->bigInteger('allocated')->nullable()->comment('user who were automatically allocated to attend the workflow by auto assignment');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('wf_tracks', function(Blueprint $table)
        {
            $table->foreign('wf_definition_id')->references('id')->on('wf_definitions')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('parent_id')->references('id')->on('wf_tracks')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wf_tracks');
    }
}
