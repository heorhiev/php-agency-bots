<?php

namespace app\services;


class SettingsService extends Service
{
    /**
     * @throws \Exception
     */
    public function __construct($fileName, $dto)
    {
        $path = SETTINGS_PATH . '/' . $fileName . '.json';

        if (!file_exists($path)) {
            throw new \Exception("Settings file {$fileName} not found!");
        }

        return new $dto(json_decode(file_get_contents($path)));
    }
}