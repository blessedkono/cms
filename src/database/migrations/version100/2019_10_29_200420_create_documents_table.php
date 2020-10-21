<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->string('name', 50);
            $table->smallInteger('document_group_id');
            $table->text('description')->nullable();
            $table->smallInteger('isrecurring')->default(0);
            $table->smallInteger('ismandatory')->default(1);
            $table->smallInteger('isactive')->default(1);
            $table->smallInteger('isrenewable')->default(0)->comment('Flag to specify if the document is renewable');
            $table->timestamps();

        });

        Schema::table('documents', function(Blueprint $table)
        {
            $table->foreign('document_group_id')->references('id')->on('document_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
