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

        $this->formConfig = (array) $this->makeConfig($this->formConfig);

        parent::__construct();

        BackendMenu::setContext('Crydesign.Wiki', 'wiki', 'templates');

        $this->addCss('/plugins/crydesign/wiki/assets/sass/styles.scss');

        $model = $this->formGetModel();

        if(!isset($model->type)) {
            $this->vars['type'] = last(explode('/', \Request::path()));
        } else {
            $this->vars['type'] = $model->type;
        }

        switch ($this->vars['type']) {
            case 'group':
                $this->formConfig['name'] = 'Group';
                $this->formConfig['form'] = '$/crydesign/wiki/models/template/group_fields.yaml';
                break;
            case 'template':
                $this->formConfig['name'] = 'Template';
                $this->formConfig['form'] = '$/crydesign/wiki/models/template/template_fields.yaml';
                break;
            case 'extension':
                $this->formConfig['name'] = 'Extension';
                $this->formConfig['form'] = '$/crydesign/wiki/models/template/extension_fields.yaml';
            default:
                break;
        }

        dump($this);
    }

    public function formBeforeCreate($model)
    {
        $model->type = $this->vars['type'];
    }
}
