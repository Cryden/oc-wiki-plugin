<?php namespace Crydesign\Wiki\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('crydesign_wiki_templates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->json('fields');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crydesign_wiki_templates');
    }
}
