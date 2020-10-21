<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //drop column category id from  blog

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('category_id');

        });

        Schema::create('blog_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('category_id');
            $table->smallInteger('blog_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_category');
    }
}
