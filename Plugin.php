<?php

namespace Crydesign\Wiki;

use Backend;
use Event;
use Lang;
use \System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function boot() 
    {
        Event::listen('backend.form.refresh', function ($formWidget, $result) {

            // \Debugbar::info($formWidget->model);

            // if ($formWidget->model instanceof \Crydesign\Wiki\Models\Template) {
            //     //\Debugbar::info($formWidget->getField('parent')->value);
            //     // $formWidget->addFields([
            //     //     'article[myfield]' => [
            //     //         'label'   => 'My Field',
            //     //         'comment' => 'This is a custom field I have added.',
            //     //     ],
            //     // ]);
    
            //     // $result['#Form'] = $formWidget->render();
    
            //     // \Debugbar::info($result);
    
            //     return $result;
            // }
        });
    }
    public function pluginDetails()
    {
        return [
            'name' => Lang::get('crydesign.wiki::lang.app.name'),
            'description' => Lang::get('crydesign.wiki::lang.app.description'),
            'author' => 'CRYDEsigN',
            'icon' => 'icon-wikipedia-w'
        ];
    }

    public function registerNavigation()
    {
        return [
            'wiki' => [
                'label'       => Lang::get('crydesign.wiki::lang.app.name'),
                'url'         => Backend::url('crydesign/wiki/articles'),
                'icon'        => 'icon-wikipedia-w',
                'permissions' => ['crydesign.wiki.*'],
                'order'       => 500,
                'sideMenu' => [
                    'articles' => [
                        'label'       => Lang::get('crydesign.wiki::lang.article.articles'),
                        'icon'        => 'icon-file-text-o',
                        'url'         => Backend::url('crydesign/wiki/articles'),
                        'permissions' => [],
                    ],
                    'templates' => [
                        'label'       => Lang::get('crydesign.wiki::lang.template.templates'),
                        'icon'        => 'icon-th-large',
                        'url'         => Backend::url('crydesign/wiki/templates'),
                        'permissions' => [],
                    ]
                ]
            ],
        ];
    }
}
