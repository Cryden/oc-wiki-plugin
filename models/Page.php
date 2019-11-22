<?php namespace Crydesign\Wiki\Models;

use Model;

/**
 * Page Model
 */
class Page extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'crydesign_wiki_pages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

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
}
