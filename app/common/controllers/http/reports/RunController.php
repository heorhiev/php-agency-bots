<?php

namespace app\common\controllers\http\reports;

use app\common\bots\vacancy\entities\Contact;
use app\common\controllers\Controller;
use app\common\dto\config\GoogleSheetDto;
use app\common\services\googleSheets\UploadService;
use app\common\services\SettingsService;


class RunController extends Controller
{
    public function main()
    {
        $contact = Contact::repository()
            ->findById(1)
            ->asEntityOne();

        $service = new UploadService(SettingsService::load('vacancy/google_sheet', GoogleSheetDto::class));

        $service->save([
            $contact->getAttributes(['id', 'name', 'phone'])
        ]);
    }
}