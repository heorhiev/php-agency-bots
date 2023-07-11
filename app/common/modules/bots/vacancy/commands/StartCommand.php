<?php

namespace app\common\modules\bots\vacancy\commands;

use app\common\modules\bots\vacancy\VacancyBot;
use TelegramBot\Api\Types\Message;


class StartCommand
{
    public static function run(VacancyBot $bot, Message $message)
    {
        $bot->sendMessage($message->getChat()->getId(), 'start');
    }
}