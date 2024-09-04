<?php namespace CustomChat\ChatPlugin;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'ChatPlugin',
            'description' => 'Provides chat functionality between users with file uploads and emoji reactions.',
            'author' => 'CustomChat',
            'icon' => 'icon-comments'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        // Register services or custom bindings if needed
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        // Register the middleware for API authentication
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            // Register any frontend components here, if applicable
            // Example: 'CustomChat\ChatPlugin\Components\ChatComponent' => 'chatComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
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

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'chatplugin' => [
                'label' => 'ChatPlugin',
                'url' => Backend::url('customchat/chatplugin/messages'),
                'icon' => 'icon-comments',
                'permissions' => ['customchat.chatplugin.*'],
                'order' => 500,
                'sideMenu' => [
                    'chats' => [
                        'label' => 'Chats',
                        'icon' => 'icon-comments',
                        'url' => Backend::url('customchat/chatplugin/chats'),
                        'permissions' => ['customchat.chatplugin.manage_chats']
                    ],
                    'messages' => [
                        'label' => 'Messages',
                        'icon' => 'icon-envelope',
                        'url' => Backend::url('customchat/chatplugin/messages'),
                        'permissions' => ['customchat.chatplugin.manage_messages']
                    ],
                ]
            ],
        ];
    }
}
