<?php namespace Crydesign\Wiki\Models;

use Model;

/**
 * Template Model
 */
class Template extends Model
{
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

    public function getTemplateField()
    {
        $options = [
            '_date'  => "Date",
            '_img'   => "Image",
            '_str'   => "String"
        ];

        $template = \Crydesign\Wiki\Models\Template::get()->lists('title', 'index');

        $template = $template + $options;

        return $template;
    }

    public function beforeSave() {
        if ($this->index{0} != '_') {
            $this->index = '_'.mb_strtolower($this->title);
        }

        if (is_array($this->shema)) {

            $new_shema = [];
            foreach ($this->shema as $key1 => $value) {
                $shema_array = [];
                foreach ($value as $key2 => $ft) {
                    // trace_log($key2, ' ', $ft);
                    if ($key2 == 'field_type') {
                        $type_array = [];
                        foreach ($ft as $key3 => $value) {
                            if ($value{0} != '_') {
                                $new_template = Template::create(['title' => $value ]);
                                $shema_array[$key2][$key3] = $new_template->index;
                            } else {
                                $shema_array[$key2][$key3] = $value;
                            }
                        }

                    } else {
                        $shema_array[$key2] = $ft;
                    }
                }

                $new_shema[$key1] = $shema_array;
            }

            $this->shema = $new_shema;
        }
    }
}
