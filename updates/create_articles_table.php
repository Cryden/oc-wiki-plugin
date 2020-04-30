<?php namespace Crydesign\Wiki\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('crydesign_wiki_articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('wiki_id')->nullable();
            $table->string('wiki_title')->nullable();
            $table->string('template');
            $table->json('article')->nullable();
            $table->string('permalink')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crydesign_wiki_articles');
    }
}
