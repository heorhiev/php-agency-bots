<?php

namespace app\common\controllers\http\telegram;

use app\common\modules\bots\VacancyBot;
use app\common\services\LoggerService;


class VacancyController extends \app\common\controllers\Controller
{
    public function main()
    {
        try {
            (new VacancyBot())->run();
        } catch (\Exception $e) {
            LoggerService::error($e->getMessage());
        }
    }
}
