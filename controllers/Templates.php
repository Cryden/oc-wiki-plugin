<?php namespace Crydesign\Wiki\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Yaml;

/**
 * Templates Back-end Controller
 */
class Templates extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    //public $bodyClass = 'compact-container';
    public $templates = '';

    public function __construct()
    {
        parent::__construct();

        // BackendMenu::setContext('Crydesign.Wiki', 'wiki', 'templates');
    }

    public function index()
    {
        
        $this->addCss('/plugins/crydesign/wiki/assets/sass/styles.scss');
        
        $this->pageTitle = 'Панель управления';
        $this->bodyClass = 'compact-container';
    }

    public function formExtendFields($form)
    {
        // if (!isset($form->model->type)) {
        //     $type = last(explode('/', \Request::path()));
        // } else {
        //     $type = $form->model->type;
        // }

        // switch ($type) {
        //     case 'template':
        //         $fields = Yaml::parseFile(plugins_path().'/crydesign/wiki/models/template/template_fields.yaml');
        //         break;
        //     case 'group':
        //         $fields = Yaml::parseFile(plugins_path().'/crydesign/wiki/models/template/group_fields.yaml');
        //         break;
        //     case 'extension':
        //         $fields = Yaml::parseFile(plugins_path().'/crydesign/wiki/models/template/extension_fields.yaml');
        //         break;

        //     default:
        //         $fields = [];
        //         break;
        // }

        // $form->addTabFields($fields);

        // \Debugbar::log($type);
    }
}
