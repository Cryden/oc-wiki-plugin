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
        // $fields->_test->value = 'changed';
    }

    public function beforeSave() 
    {
        // Article Status
        if ($this->status == null) {
            $this->status = 'created';
        }
        
        // Article Wiki Id
        //$this->wiki_id = snake_case($this->template.$this->article['title']);

        // Article Permalink
        // if ($this->status !== 'created') {
        //     // \Debugbar::info('not check');
        // } else {
        //     \Debugbar::info('check');
        //     $template = Template::where('index', $this->template)->first();
        //     $permalink_pattern = $template->permalink;
        //     $pattern = explode("/", $permalink_pattern);
        //     array_shift($pattern);
        //     $permalink = '';

        //     foreach ($pattern as $value) {
        //         if ($value{0} != ':') {
        //             $value = '/'.$value;
        //         } else {
        //             foreach ($template->shema as $field) {
        //                 if ($value == $field['alias']) {
        //                     $field_title = $field['field_title'];
        //                 }
        //             }
        //             $value = '/'.\Str::slug($this->article[$field_title]);
        //         }
        //         $permalink = $permalink.$value;
        //     }

        //     $this->permalink = $permalink;
        //     $this->status = "draft";
        // }
    }
}
