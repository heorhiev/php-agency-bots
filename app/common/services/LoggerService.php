<?php

namespace app\common\services;


class LoggerService extends Service
{
    public static function info($text)
    {
        $fileName = date('Y-m-d') . '-info.log';
        return file_put_contents(LOGS_PATH . '/' . $fileName, $text, FILE_APPEND);
    }


    public static function error($text)
    {
        $fileName = date('Y-m-d') . '-errors.log';
        return file_put_contents(LOGS_PATH . '/' . $fileName, $text, FILE_APPEND);
    }
}