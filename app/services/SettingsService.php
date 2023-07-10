<?php

namespace app\services;


class SettingsService extends Service
{
    /**
     * @throws \Exception
     */
    public static function load($fileName, $dto)
    {
        $path = CONFIG_PATH . '/' . $fileName . '.json';

        if (!file_exists($path)) {
            throw new \Exception("Settings file {$fileName} not found!");
        }

        return new $dto(json_decode(file_get_contents($path), true));
    }
}