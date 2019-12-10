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

    public $timestamps = false;

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['metainfo'];

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

        $template = \Crydesign\Wiki\Models\Template::all()->lists('title', 'slug');

        $options = array_merge($options, $template);

        return $options;
    }

    public function beforeSave()
    {
        
    }

}
