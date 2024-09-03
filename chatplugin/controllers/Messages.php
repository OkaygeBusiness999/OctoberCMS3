<?php namespace CustomChat\ChatPlugin\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use CustomChat\ChatPlugin\Models\Message;

class Messages extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('CustomChat.ChatPlugin', 'chatplugin', 'messages');
    }

    public function listExtendFields($widget)
    {
        if (!$widget->getController() instanceof ListController) {
            return;
        }
        
        $widget->addButton('create', [
            'label' => 'Create Chat',
            'class' => 'btn btn-primary',
            'icon' => 'icon-plus',
            'href' => URL::to('/backend/customchat/chatplugin/messages/create'),
            'context' => 'toolbar'
        ]);
    }
}
