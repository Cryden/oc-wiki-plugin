<?php namespace Crydesign\Wiki\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;

/**
 * Templates Back-end Controller
 */
class Templates extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form_template.yaml';
    public $listConfig = 'config_list.yaml';

    //public $bodyClass = 'compact-container';
    public $templates = '';

    public function __construct()
    {
        $this->vars['type'] = last(explode('/', \Request::path()));
        
        switch ($this->vars['type']) {
            case 'group':
                $this->formConfig = 'config_form_group.yaml';
                break;
            case 'template':
                $this->formConfig = 'config_form_template.yaml';
                break;
            case 'extension':
                $this->formConfig = 'config_form_extension.yaml';
            default:
                break;
        }

        parent::__construct();
        BackendMenu::setContext('Crydesign.Wiki', 'wiki', 'templates');
        $this->addCss('/plugins/crydesign/wiki/assets/sass/styles.scss');
    }

    public function create() 
    {
        parent::create();
        

    }

    // public function index()
    // {
    //     $this->pageTitle = 'Панель управления';
    //     $this->bodyClass = 'compact-container';
    // }

    // public function onDelete() {
    //     \Crydesign\Wiki\Models\Template::destroy($_POST['id']);
    //     // Flash::info($_POST['id']);
    // }
}
