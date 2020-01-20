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
        if ($this->index{0} != '_') {
            $this->index = '_'.mb_strtolower($this->title);
        }

        // if (is_array($this->shema)) {

        //     $new_shema = [];
        //     foreach ($this->shema as $key1 => $value) {
        //         $shema_array = [];
        //         foreach ($value as $key2 => $ft) {
        //             // trace_log($key2, ' ', $ft);
        //             if ($key2 == 'field_type') {
        //                 $type_array = [];
        //                 foreach ($ft as $key3 => $value) {
        //                     if ($value{0} != '_') {
        //                         $new_template = Template::create(['title' => $value ]);
        //                         $shema_array[$key2][$key3] = $new_template->index;
        //                     } else {
        //                         $shema_array[$key2][$key3] = $value;
        //                     }
        //                 }

        //             } else {
        //                 $shema_array[$key2] = $ft;
        //             }
        //         }

        //         $new_shema[$key1] = $shema_array;
        //     }

        //     $this->shema = $new_shema;
        // }
    }

    public function filterFields($fields, $context = null)
    {
        \Debugbar::info($fields);
        // $fields->permalink->value = $fields->parent->value.'/'.$fields->slug->value;
    }
}
