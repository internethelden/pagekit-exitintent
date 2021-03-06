<?php

namespace Spqr\Exitintent\Plugin;

use Pagekit\Application as App;
use Pagekit\View\Event\ViewEvent;
use Pagekit\Event\EventSubscriberInterface;

class ExitintentPlugin implements EventSubscriberInterface
{
    public function onViewContent(ViewEvent $event)
    {
        
        $module = App::module('spqr/exitintent');
        $config = $module->config;
        
        if ((!$config['nodes']
            || in_array(App::request()->attributes->get('_node'),
                $config['nodes']))
        ) {
            $html = (!empty($config['html']) ? $config['html'] : '');
            $event->addResult('<div id="exit-modal" class="uk-modal"><div class="uk-modal-dialog"><a href="" class="uk-modal-close uk-close"></a>'
                .$html.'</div></div>');
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'view.content' => ['onViewContent', 10],
        ];
    }
}