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

    public function beforeSave() 
    {
        // Set Permalink
        if ($this->type != 'extension') {
            if (!$this->parent) {
                $this->parent_permalink = '';
            } else {
                $this->parent_permalink = $this->parent->permalink;
                $this->permalink = $this->parent_permalink.'/'.$this->slug;
            }
        } else {
            $this->permalink = null;
        }

        // Set Index
        $this->index = str_limit('tmp_'.snake_case($this->type).'_'.snake_case($this->title).'_'.str_random(10), 30);
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
    }

    public function scopeExtension($query)
    {
        return $query->where('type', 'template');
    }

    public function scopeTemplate($query)
    {
        return $query->where('type', '!=', 'extension');
    }

    public function getIconList()
    {
        return \Crydesign\Wiki\Classes\IconList::getList();
    }

    public function getTypeList()
    {
        return [
            'template' => 'Template',
            'group'    => 'Group',
            'extension'=> 'Extension',
        ];
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

    public function filterFields($fields, $context = null)
    {
        // Set Permalink
        if (isset($fields->parent) and $fields->type->value != 'extension') {
            if ($fields->parent->value == 0) {
                $fields->permalink->value = '/'.$fields->slug->value;
            } else {
                $node = $this::find($fields->parent->value)->permalink;
                $fields->permalink->value = $node.'/'.$fields->slug->value;
            }
        }
    }
}
