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

    public function iconList()
    {
        return \Crydesign\Wiki\Classes\IconList::getList();
    }

    public function getStandartTemplateField()
    {
        $options = [
            '_str'   => "String",
            '_date'  => "Date",
            '_img'   => "Image",
        ];

        return $options;
    }

    public function getRelationTemplateField()
    {
        $template = \Crydesign\Wiki\Models\Template::get()->lists('title', 'index');

        return $template;
    }

    public function getFilterTemplateField()
    {
        return;
    }

    public function beforeSave() {
        //\Debugbar::info($this);

        if ($this->index{0} != '_') {
            $this->index = '_'.mb_strtolower($this->title);
        }

        if (!$this->parent) {
            $this->parent_permalink = '';
        } else {
            $this->parent_permalink = $this->parent->permalink;
            $this->permalink = $this->parent_permalink.'/'.$this->slug;
        }
        
    }

    public function afterSave() 
    {
        // Меняем постоянные ссылки в случае смены слага
        $childrens = $this->getChildren();

        trace_log($this->getParent());

        if ($childrens->first() != null) {
            if($childrens->first()->parent_permalink <> $this->permalink) {
                foreach ($childrens as $children) {
                    $children->save();
                }
            }
        }
    }
    public function filterFields($fields, $context = null)
    {

        if (isset($fields->parent)) {
            if ($fields->parent->value == 0) {
                $fields->permalink->value = '/'.$fields->slug->value;
            } else {
                $node = $this::find($fields->parent->value)->permalink;
                $fields->permalink->value = $node.'/'.$fields->slug->value;
            }
        }
    }
}
