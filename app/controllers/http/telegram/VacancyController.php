<?php

namespace App\Controllers\Http\telegram;


use app\services\SettingsService;

class VacancyController extends \App\Controllers\Http\Controller
{
    public function main()
    {
        $telegramSettings = new SettingsService('telegram');

        $options = $telegramSettings->getOption('vacancy_bot.token');
        print_r($options);
    }
}