<?php

namespace app\common\modules\bots;

use app\common\enteties\dto\config\TelegramDto;
use app\common\services\SettingsService;


abstract class Bot
{
    protected $_options;

    public function __construct()
    {
        /** @var TelegramDto $options */
        $this->_options = SettingsService::load('telegram', TelegramDto::class);
    }


    abstract public function run();
}