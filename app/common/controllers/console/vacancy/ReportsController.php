<?php

namespace app\common\controllers\console\vacancy;

use app\common\bots\vacancy\constants\VacancyBotConst;
use app\common\bots\vacancy\entities\Contact;
use app\common\controllers\Controller;
use app\common\services\googleSheets\UpdateService;


class ReportsController extends Controller
{
    const APP_NAME = 'vacancyBot';
    const CRED_PATH = CONFIG_PATH . '/vacancy_google_sheet_key.json';
    const SHEET_ID = '1IzDCrACjuIgr91QWCBBBy8VKsO9PudRYuxUvLuBQLEk';

    const LIST_NAME = 'List1';

    public function main()
    {
        $contacts = Contact::repository()
            ->select(['id', 'name', 'phone'])
            ->filter(['status' => VacancyBotConst::CONTACT_STATUS_NEW])
            ->asArrayAll();

        $service = new UpdateService(
            self::APP_NAME,
            self::CRED_PATH
        );

        if ($service->upload(self::SHEET_ID, self::LIST_NAME, $contacts)) {
            Contact::repository()->update(
                ['status' => VacancyBotConst::CONTACT_STATUS_UPLOADED],
                ['status' => VacancyBotConst::CONTACT_STATUS_NEW]
            );
        }
    }
}