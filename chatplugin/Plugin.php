<?php namespace CustomChat\ChatPlugin;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'ChatPlugin',
            'description' => 'Provides chat functionality between users with file uploads and emoji reactions.',
            'author' => 'CustomChat',
            'icon' => 'icon-comments'
        ];
    }

    public function register()
    {
        // Register services or custom bindings if needed
    }

    public function boot()
    {
        // Register the middleware for API authentication
    }

    public function registerComponents()
    {
        return [];
    }

    public function registerPermissions()
    {
        return [
            'customchat.chatplugin.manage_chats' => [
                'tab' => 'ChatPlugin',
                'label' => 'Manage Chats'
            ],
            'customchat.chatplugin.manage_messages' => [
                'tab' => 'ChatPlugin',
                'label' => 'Manage Messages'
            ],
        ];
    }

    public function registerNavigation()
    {

    }
}
