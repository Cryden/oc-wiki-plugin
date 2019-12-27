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
            $table->json('shema');
            $table->integer('parent_id')->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crydesign_wiki_templates');
    }
}
