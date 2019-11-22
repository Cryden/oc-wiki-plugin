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
            $table->string('title');
            $table->longText('article');
            $table->json('infobox');
        });
    }

    public function down()
    {
        Schema::dropIfExists('crydesign_wiki_articles');
    }
}
