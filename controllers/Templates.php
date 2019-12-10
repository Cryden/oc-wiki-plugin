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
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();
        $this->addCss('/plugins/crydesign/wiki/assets/scss/styles.scss');
    }

    public function index()
    {
        $this->pageTitle = 'Панель управления';
        $this->bodyClass = 'compact-container';
    }
}
