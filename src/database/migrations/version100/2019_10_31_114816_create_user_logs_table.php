<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->integer('user_id')->nullable();
            $table->boolean('has_remember')->nullable();
            $table->smallInteger('user_log_cv_id');
            $table->text('browser')->nullable();
            $table->text('browser_version')->nullable();
            $table->text('device')->nullable();
            $table->text('platform')->nullable();
            $table->text('platform_version')->nullable();
            $table->boolean('isdesktop')->nullable();
            $table->boolean('isphone')->nullable();
            $table->boolean('isrobot')->nullable();
            $table->text('robot_name')->nullable();
            $table->string('username', 30)->nullable();
            $table->boolean('ismobile')->nullable();
            $table->boolean('istablet')->nullable();
            $table->text('location')->nullable();
            $table->timestamps();
        });

        Schema::table('user_logs', function(Blueprint $table)
        {
            $table->foreign('user_log_cv_id')->references('id')->on('code_values')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
        Schema::dropIfExists('user_logs');
    }
}
