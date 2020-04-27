<?php namespace Crydesign\Wiki\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTemplatesTable27042020000 extends Migration
{
    public function up()
    {
        Schema::table('crydesign_wiki_templates', function (Blueprint $table) {
            $table->json('extension')->nullable();
        });
    }

    public function down()
    {
        Schema::table('crydesign_wiki_templates', function($table)
        {
            $table->dropColumn('extension');
        });
    }
}
