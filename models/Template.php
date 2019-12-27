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
    protected $fillable = [];

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
            'date'  => "Date",
            'img'   => "Image",
            'str'   => "String"
        ];

        $template = \Crydesign\Wiki\Models\Template::get()->pluck('title', 'id');

        $template = collect($template);
        $options = collect($options);

        $options = $template->merge($options);

        trace_log($options);

        return $options;
    }

    public function beforeSave()
    {
        
    }

}
