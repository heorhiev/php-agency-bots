<?php

namespace app\common\modules\bots;

use app\common\services\LoggerService;
use app\common\modules\bots\vacancy\StartCommand;
use TelegramBot\Api\Types\Message;
use app\common\services\LangService;


class VacancyBot extends Bot
{
    public $_bot;

    public function run()
    {
        $this->_bot = new \TelegramBot\Api\Client($this->_options->vacancyBotToken);

        $this->_bot->command('start', function(Message $message) {
            StartCommand::run($this, $message);
        });

        //Handle text messages
        $this->_bot->on(function (\TelegramBot\Api\Types\Update $update) {
            $message = $update->getMessage();
            $id = $message->getChat()->getId();
            $this->_bot->sendMessage($id, 'Your message: ' . $message->getText());
        }, function () {
            return true;
        });

        $this->_bot->run();
    }


    public function sendMessage($userId, $messageKey, $message = null)
    {
        if (empty($message)) {
            $text = $this->getOptions()->vacancyBotTexts[$messageKey];
            $message = LangService::getLangValue($text, 'ru', $this->getOptions()->defaultLang);
        }

        $this->_bot->sendMessage($userId, $message);
    }
}