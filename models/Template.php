<?php namespace Crydesign\Wiki\Models;

use Model;

/**
 * Template Model
 */
class Template extends Model
{
    use \October\Rain\Database\Traits\NestedTree;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'crydesign_wiki_templates';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['title'];

    protected $jsonable = ['shema'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public $standart_fields = [
        '_str'   => "String",
        '_editor'=> "Editor",
        '_date'  => "Date",
        '_img'   => "Image",
    ];

    public function getIconList()
    {
        return \Crydesign\Wiki\Classes\IconList::getList();
    }

    public function getStandartTemplateField()
    {
        return $this->standart_fields;
    }

    public function getRelationTemplateField()
    {
        $template = \Crydesign\Wiki\Models\Template::where('index', '!=', null)->get()->lists('title', 'index');

        return $template;
    }

    public function getFilterTemplateField()
    {
        return;
    }

    public function beforeSave() {
        if (!$this->parent) {
            $this->parent_permalink = '';
        } else {
            $this->parent_permalink = $this->parent->permalink;
            $this->permalink = $this->parent_permalink.'/'.$this->slug;
        }

        // if ($this->slug{0} == ':') {
        //     $check = $this::where('index', '_'.snake_case($this->title ))->first();
        //     if (!isset($check) or $this->index == '_'.snake_case($this->title)) {
        //         $this->index = '_'.snake_case($this->title);
        //     } else {
        //         $this->index = '_'.snake_case($this->title.rand());
        //     }
            
        //     // $this->save();
        // } else {
        //     $this->index = null;
        // }
    }

    public function afterSave() 
    {
        // Change all Templates Permalink Pattern after Template Permalink change
        $childrens = $this->getChildren();

        if ($childrens->first() != null) {
            if($childrens->first()->parent_permalink <> $this->permalink) {
                foreach ($childrens as $children) {
                    $children->save();
                }
            }
        }

        // Change all Articles Permalink Pattern after Template Permalink change
        // $articles = Article::where('template', $this->index)->get();
        // foreach ($articles as $article) {
        //     $article->save();
        // }
    }

    public function filterFields($fields, $context = null)
    {
        if (!isset($fields->type->value)) {
            $fields->type->value = last(explode('/', \Request::path()));
        } 

        if ($fields->type->value == "extension") {
            $fields->parent->tab = "Template";
            $fields->parent->label = "Template";
        }

        if (isset($fields->parent)) {
            if ($fields->parent->value == 0) {
                $fields->permalink->value = '/'.$fields->slug->value;
            } else {
                $node = $this::find($fields->parent->value)->permalink;
                $fields->permalink->value = $node.'/'.$fields->slug->value;
            }
        }

        // \Debugbar::log($fields);
    }
}
