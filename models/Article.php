<?php namespace Crydesign\Wiki\Models;

use Model;

/**
 * Article Model
 */
class Article extends Model
{
    use \October\Rain\Database\Traits\Revisionable;

    public $table = 'crydesign_wiki_articles';

    protected $guarded = ['*'];

    protected $revisionable = ['title', 'article', 'infobox'];

    protected $fillable = [];

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
}
