<?php namespace CustomChat\ChatPlugin\Models;

use Model;
use System\Behaviors\SettingsModel;

class Settings extends Model
{
    public $implement = [SettingsModel::class];

    public $settingsCode = 'customchat_settings';
    public $settingsFields = 'fields.yaml';
}
