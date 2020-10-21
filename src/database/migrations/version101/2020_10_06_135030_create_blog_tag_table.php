<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('blog_id');
            $table->smallInteger('tag_id');
            $table->timestamps();
        });

        Schema::table('blog_tag', function(Blueprint $table)
        {
            $table->foreign('blog_id')->references('id')->on('blogs')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_tag');
    }
}
