<?php

namespace app\common\controllers\http\telegram;

use app\common\enteties\dto\config\TelegramDto;
use app\common\services\SettingsService;


class VacancyController extends \app\common\controllers\Controller
{
    public function main()
    {
        /** @var TelegramDto $options */
        $options = SettingsService::load('telegram', TelegramDto::class);

        echo 'ddd';
        return;
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
