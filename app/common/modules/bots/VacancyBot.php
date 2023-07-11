<?php

namespace app\common\modules\bots;


use app\common\services\LoggerService;

class VacancyBot extends Bot
{
    public function run()
    {
        $bot = new \TelegramBot\Api\Client($this->_options->vacancyBotToken);

        $bot->command('start', function ($message) use ($bot) {
            LoggerService::info($message->getChat()->getId());
        });

        //Handle text messages
        $bot->on(function (\TelegramBot\Api\Types\Update $update) use ($bot) {
            $message = $update->getMessage();
            $id = $message->getChat()->getId();
            $bot->sendMessage($id, 'Your message: ' . $message->getText());
        }, function () {
            return true;
        });

        $bot->run();
    }
}