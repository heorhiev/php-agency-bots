<?php

namespace app\common\dto\config;

use app\common\dto\Dto;


class GoogleSheetDto extends Dto
{
    public $appName;
    public $apiKeyPath;
    public $sheetId;
    public $listName;
}