<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserLikesArticleForeignKeysOndeleteCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_likes_article', function (Blueprint $table) {
            $table->dropForeign('user_likes_article_user_id_foreign');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            
            $table->dropForeign('user_likes_article_article_id_foreign');
            $table->foreign('article_id')
                  ->references('id')->on('articles')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_likes_article', function (Blueprint $table) {
            $table->dropForeign('user_likes_article_user_id_foreign');
            $table->foreign('user_id')
                  ->references('id')->on('users');
            
            $table->dropForeign('user_likes_article_article_id_foreign');
            $table->foreign('article_id')
                  ->references('id')->on('articles');
        });
    }
}
