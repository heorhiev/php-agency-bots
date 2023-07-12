<?php

namespace app\common\bots\vacancy\commands;

use app\common\bots\vacancy\entities\Contact;
use app\common\bots\vacancy\VacancyBot;
use TelegramBot\Api\Types\Message;


class StartCommand
{
    public static function run(VacancyBot $bot, ?Message $message)
    {

        Contact::repository()->update(['name' => 'xxx'], ['id' => 1]);
        exit;

        $contact = Contact::repository()->findById(1)->asEntityOne();

        print_r($contact);

        exit;
        $bot->sendMessage($message->getChat()->getId(), 'start');
    }
}