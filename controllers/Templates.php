<?php namespace Crydesign\Wiki\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Templates Back-end Controller
 */
class Templates extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
    ];

    public $formConfig = 'config_form.yaml';

    public $bodyClass = 'compact-container';
    public $templates = '';

    public function __construct()
    {
        parent::__construct();
        $this->addCss('/plugins/crydesign/wiki/assets/scss/styles.scss');
    }

    public function index()
    {
        $this->pageTitle = 'Панель управления';
        $this->bodyClass = 'compact-container';

        $this->templates = \Crydesign\Wiki\Models\Template::all();
    }
}
