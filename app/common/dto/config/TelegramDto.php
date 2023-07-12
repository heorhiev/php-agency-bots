<?php

namespace app\common\dto\config;

use app\common\dto\Dto;


class TelegramDto extends Dto
{
    public $defaultLang;
    public $vacancyBotToken;
    public $vacancyBotTexts;
}