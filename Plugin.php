<?php

namespace Crydesign\Wiki;

use Backend;
use Lang;

class Plugin extends \System\Classes\PluginBase
{
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
