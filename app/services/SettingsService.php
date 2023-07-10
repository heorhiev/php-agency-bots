<?php

namespace app\services;


class SettingsService extends Service
{
    private $_settings;


    /**
     * @throws \Exception
     */
    public function __construct($fileName)
    {
        $path = SETTINGS_PATH . '/' . $fileName . '.json';

        if (!file_exists($path)) {
            throw new \Exception("Settings file {$fileName} not found!");
        }

        $this->_settings = json_decode(file_get_contents($path));
    }


    public function getOption(string $key, $default = null)
    {
        return ArrayService::getValue($this->_settings, $key, $default);
    }
}