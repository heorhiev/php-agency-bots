<?php

namespace app\common\services;


class LangService extends Service
{
    public static function getLangValue($text, $lang, $defaultLang = null)
    {
        if (!isset($text[$lang]) && $defaultLang) {
            $lang = $defaultLang;
        }

        return $text[$lang];
    }
}