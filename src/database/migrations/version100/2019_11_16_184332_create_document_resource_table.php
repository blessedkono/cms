<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_resource', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->smallInteger('document_id');
            $table->bigInteger('resource_id')->index();
            $table->string('resource_type', 150);
            $table->string('name', 191)->comment('Original name of the document.');
            $table->text('description')->nullable();
            $table->string('ext', 10);
            $table->decimal('size', 10, 0);
            $table->string('mime', 300);
            $table->smallInteger('isactive')->default(1)->comment('Flag to specify if document is active i.e. 1 => active, 0 => not active');
            $table->timestamps();

        });

        Schema::table('document_resource', function(Blueprint $table)
        {
            $table->foreign('document_id')->references('id')->on('documents')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_resource');
    }
}
