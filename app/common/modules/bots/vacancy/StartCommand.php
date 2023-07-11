<?php

namespace app\common\modules\bots\vacancy;

use app\common\modules\bots\VacancyBot;
use TelegramBot\Api\Types\Message;


class StartCommand
{
    public static function run(VacancyBot $bot, Message $message)
    {
        $bot->sendMessage($message->getChat()->getId(), 'start');
    }
}