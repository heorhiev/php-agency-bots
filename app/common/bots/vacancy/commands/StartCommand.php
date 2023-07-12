<?php

namespace app\common\bots\vacancy\commands;

use app\common\bots\vacancy\entities\Contact;
use app\common\bots\vacancy\VacancyBot;
use TelegramBot\Api\Types\Message;


class StartCommand
{
    public static function run(VacancyBot $bot, Message $message)
    {
        $bot->sendMessage($message->getChat()->getId(), 'start');
    }
}