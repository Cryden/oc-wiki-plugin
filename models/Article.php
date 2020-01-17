<?php namespace Crydesign\Wiki\Models;

use Model;
use BackendAuth;

/**
 * Article Model
 */
class Article extends Model
{
    use \October\Rain\Database\Traits\Revisionable;

    public $table = 'crydesign_wiki_articles';

    protected $guarded = ['*'];

    protected $revisionable = ['title', 'article', 'shema'];

    protected $fillable = ['title', 'template'];

    protected $jsonable = ['article'];

    public $timestamps = false;
 
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];
    public $attachOne = [];
    public $attachMany = [];

    /** Method in your model to keep track of the user that made the modification */
    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }

    /** Template Dropdow options */
    public function getTemplateOptions() 
    {
        $options = \Crydesign\Wiki\Models\Template::get()->lists('title', 'index');
        return $options;
    }

    public function filterFields($fields, $context = null)
    {
        $fields->_test->value = 'changed';
    }

    public function beforeSave() 
    {
        $template = \Crydesign\Wiki\Models\Template::where('index',$this->template)->first();
        $fields_array = $template->shema;

        foreach ($fields_array as $key => $value) {
            if ($value['field_type'][0] != '_str' && $value['field_type'][0] != '_img' && $value['field_type'][0] != '_date') {
                $field_type = $value['field_type'][0];
                foreach ($this->article[$value['field_title']] as $value) {
                    $keys = explode("_", $value);
                    // trace_log($keys);
                    if (!(\Crydesign\Wiki\Models\Article::where('id', $keys[0])->first())) {
                        Article::create([ 'title' => $value, 'template' => $field_type ]);
                    }
                }
            }
        }
    }
}
