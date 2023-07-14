<?php

namespace app\common\bots\vacancy;

use app\common\components\Bot;
use app\common\bots\vacancy\commands\StartCommand;
use app\common\bots\vacancy\commands\MessageCommand;
use app\common\services\RenderService;
use TelegramBot\Api\Types\Message;


class VacancyBot extends Bot
{
    public $_bot;
    public $_inlineKeyboardMarkup;
    public $_replyKeyboardMarkup;


    public function handler()
    {
        $this->_bot = new \TelegramBot\Api\Client($this->_options->vacancyBotToken);

        $this->_bot->command('start', function(Message $message) {
            (new StartCommand($this, $message))->run();
        });

        //Handle text messages
        $this->_bot->on(function (\TelegramBot\Api\Types\Update $update) {
            (new MessageCommand($this, $update->getMessage()))->run();
        }, function () {
            return true;
        });

        $this->_bot->run();
    }


    public function setInlineKeyboardMarkup($inlineKeyboardMarkup)
    {
        $this->_inlineKeyboardMarkup = $inlineKeyboardMarkup;
    }


    public function setReplyKeyboardMarkup($replyKeyboardMarkup)
    {
        $this->_replyKeyboardMarkup = $replyKeyboardMarkup ;
    }


    public function sendMessage($userId, $messageKey, $message = null, array $attributes = [])
    {
        if (empty($message)) {
            $userLang = null;
            $message = $this->getViewContent($messageKey, $attributes, $userLang);
        }

        $keyboard = null;

        if ($this->_inlineKeyboardMarkup) {
            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($this->_inlineKeyboardMarkup);
        }

        if ($this->_replyKeyboardMarkup) {
            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup($this->_replyKeyboardMarkup, true, false, true);
        }

        $this->_bot->sendMessage($userId, $message, 'html', false, null, $keyboard);
    }


    private function getViewContent($messageKey, $attributes, $lang = null): ?string
    {
        $path = COMMON_PATH . '/bots/vacancy/views/' . $messageKey;

        if ($lang) {
            $langPath = $path . '.' . $lang;

            if (RenderService::exists($langPath)) {
                $path = $langPath;
            }
        }

        return RenderService::get($path, $attributes);
    }
}