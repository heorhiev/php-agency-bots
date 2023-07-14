<?php

namespace app\common\controllers\http\telegram;

use app\common\bots\vacancy\VacancyBot;
use app\common\services\LoggerService;


class VacancyController extends \app\common\controllers\Controller
{
    public function main()
    {
        try {
            (new VacancyBot())->handler();
        } catch (\Exception $e) {
            echo '<pre>';
            print_r($e);
            LoggerService::error($e);
        }
    }
}
