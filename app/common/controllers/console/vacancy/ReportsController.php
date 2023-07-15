<?php

namespace app\common\controllers\console\vacancy;

use app\common\bots\vacancy\constants\VacancyBotConst;
use app\common\bots\vacancy\entities\Contact;
use app\common\controllers\Controller;
use app\common\dto\config\GoogleSheetDto;
use app\common\services\googleSheets\UploadService;
use app\common\services\SettingsService;


class ReportsController extends Controller
{
    public function main()
    {
        $contacts = Contact::repository()
            ->select(['id', 'name', 'phone'])
            ->filter(['status' => VacancyBotConst::CONTACT_STATUS_NEW])
            ->asArrayAll();

        print_r($contacts);
        exit;

        $service = new UploadService(SettingsService::load('vacancy/google_sheet', GoogleSheetDto::class));

        if ($service->save($contacts)) {
            Contact::repository()->update(
                ['status' => VacancyBotConst::CONTACT_STATUS_UPLOADED],
                ['status' => VacancyBotConst::CONTACT_STATUS_NEW]
            );
        }
    }
}