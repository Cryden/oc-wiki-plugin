<?php namespace Crydesign\Wiki\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Articles Back-end Controller
 */
class Articles extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Crydesign.Wiki', 'wiki', 'articles');
    }

    public function formExtendFields($form)
    {
        if ($form->context == "update") {
            $template = \Crydesign\Wiki\Models\Template::where('index',$form->data->template)->first();
            $fields_array = $template->shema;
            
            $fields = [];
    
            foreach ($fields_array as $value) {

                switch ($value['field_type'][0]) {
                    case '_str':
                        $field_options = [];
                        break;
                    case '_img':
                        $field_options = [];
                        break;
                    case '_date':
                        $field_options = [];
                        break;

                    default:
                        $options = \Crydesign\Wiki\Models\Article::where('template', $value['field_type'][0])->lists('title', 'id');
                        $field_options = [
                            'type' => 'taglist',
                            'options' => $options,
                            'mode' => 'array',
                            'useKey' => true
                        ];
                        break;
                }

                $fields = $fields + [
                    'article['.$value['field_title'].']' => [
                        'label'   => $value['field_title'],
                    ],
                ];

                $fields['article['.$value['field_title'].']'] += $field_options;
            }

            $form->addFields($fields);
        }
    }
}
