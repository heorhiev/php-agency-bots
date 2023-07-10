<?php

namespace app\controllers\http\telegram;

use app\dto\config\TelegramDto;
use app\services\SettingsService;


class VacancyController extends \app\controllers\Controller
{
    public function main()
    {
        /** @var TelegramDto $options */
        $options = SettingsService::load('telegram', TelegramDto::class);

        try {
            $bot = new \TelegramBot\Api\Client($options->vacancyBotToken);

            //Handle text messages
            $bot->on(function (\TelegramBot\Api\Types\Update $update) use ($bot) {
                $message = $update->getMessage();
                $id = $message->getChat()->getId();
                $bot->sendMessage($id, 'Your message: ' . $message->getText());
            }, function () {
                return true;
            });

            $bot->run();

        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
