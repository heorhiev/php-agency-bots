<?php

namespace app\common\services;


class LoggerService extends Service
{
    public static function info($text)
    {
        return self::put('info', $text);
    }


    public static function error($text)
    {
        return self::put('errors', $text);
    }


    private static function put(string $type, $text)
    {
        $filePath = LOGS_PATH . '/' . date('Y-m-d') . '-' . $type . '.log';
        return file_put_contents($filePath, print_r($text, 1) . PHP_EOL, FILE_APPEND);
    }
}