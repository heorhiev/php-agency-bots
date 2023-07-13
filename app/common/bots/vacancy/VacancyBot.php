<?php

namespace app\common\bots\vacancy;

use app\common\components\Bot;
use app\common\bots\vacancy\commands\StartCommand;
use app\common\services\RenderService;
use TelegramBot\Api\Types\Message;


class VacancyBot extends Bot
{
    public $_bot;

    public function handler()
    {
        $this->_bot = new \TelegramBot\Api\Client($this->_options->vacancyBotToken);

        $this->_bot->command('start', function(Message $message) {
            (new StartCommand($this, $message))->run();
        });

        //Handle text messages
        $this->_bot->on(function (\TelegramBot\Api\Types\Update $update) {

            MessageCommand::run($this, $message);

            $message = $update->getMessage();
            $id = $message->getChat()->getId();
            $this->_bot->sendMessage($id, 'Your message: ' . $message->getText());
        }, function () {
            return true;
        });

        $this->_bot->run();
    }


    public function sendMessage($userId, $messageKey, $message = null, array $attributes = [])
    {
        if (empty($message)) {
            $userLang = 'ua';
            $message = $this->getViewContent($messageKey, $attributes, $userLang);
        }

        echo $message;
        exit;

        $this->_bot->sendMessage($userId, $message);
    }


    private function getViewContent($messageKey, $attributes, $lang = null): ?string
    {
        $path = 'vacancy-bot/' . $messageKey;

        if ($lang) {
            $langPath = $path . '.' . $lang;

            if (RenderService::exists($langPath)) {
                $path = $langPath;
            }
        }

        return RenderService::get($path, $attributes);
    }
}