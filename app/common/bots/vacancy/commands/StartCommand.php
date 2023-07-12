<?php

namespace app\common\modules\vacancy\commands;

use app\common\modules\vacancy\VacancyBot;
use TelegramBot\Api\Types\Message;


class StartCommand
{
    public static function run(VacancyBot $bot, Message $message)
    {
        $bot->sendMessage($message->getChat()->getId(), 'start');
    }
}