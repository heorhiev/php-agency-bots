<?php

namespace App\Controllers\Http\telegram;

use app\dto\config\TelegramDto;
use app\services\SettingsService;


class VacancyController extends \App\Controllers\Http\Controller
{
    public function main()
    {
        /** @var TelegramDto $options */
        $options = new SettingsService('telegram', TelegramDto::class);

        $bot = new \TelegramBot\Api\BotApi($options->vacancyToken);

        $bot->sendMessage($chatId, $messageText);
    }
}
