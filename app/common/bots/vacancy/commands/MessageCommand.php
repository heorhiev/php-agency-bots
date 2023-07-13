<?php

namespace app\common\bots\vacancy\commands;

use app\common\bots\vacancy\constants\VacancyBotConst;
use app\common\components\validators\TextValidator;
use app\common\components\validators\PhoneValidator;
use app\common\services\googleSheets\UploadService;


class MessageCommand extends Command
{
    const APP_NAME = 'vacancyBot';
    const CRED_PATH = CONFIG_PATH . '/vacancy_google_sheet_key.json';
    const SHEET_ID = '1IzDCrACjuIgr91QWCBBBy8VKsO9PudRYuxUvLuBQLEk';

    const LIST_NAME = 'List1';


    public function run(): void
    {
        $this->{$this->getContact()->step}();
    }


    public function enterName(): void
    {
        $text = trim($this->getMessage()->getText());
        $text = preg_replace('/[^a-zA-ZА-Яа-я0-9-\s$]/u', '', $text);

        if ((new TextValidator())->isValid($text)) {

            $this->getContact()->update([
                'name' => $text,
                'step' => VacancyBotConst::STEP_ENTER_PHONE,
            ]);

            $key = VacancyBotConst::STEP_ENTER_PHONE;
        } else {
            $key = $this->getContact()->step . '.error';
        }

        $this->getBot()->sendMessage($this->getUserId(), $key, null, [
            'userName' => $text,
            'contact' => $this->getContact(),
        ]);
    }


    public function enterPhone(): void
    {
        $text = trim($this->getMessage()->getText());

        if ((new PhoneValidator())->isValid($text)) {
            $this->getContact()->update([
                'phone' => $text,
                'step' => VacancyBotConst::STEP_FINALE,
                'status' => VacancyBotConst::CONTACT_STATUS_FINALE,
            ]);

            $this->addButton();

            $key = VacancyBotConst::STEP_FINALE;
        } else {
            $key = $this->getContact()->step . '.error';
        }

        $this->getBot()->sendMessage($this->getUserId(), $key, null, [
            'phone' => $text,
            'contact' => $this->getContact(),
        ]);

        $service = new UploadService(
            self::APP_NAME,
            self::CRED_PATH
        );

        $service->save(self::SHEET_ID, self::LIST_NAME, [[
            $this->getContact()->id,
            $this->getContact()->name,
            $this->getContact()->phone,
        ]]);
    }


    public function finale()
    {
        $this->addButton();

        $this->getBot()->sendMessage($this->getUserId(), VacancyBotConst::STEP_FINALE, null, [
            'contact' => $this->getContact(),
            'phone' => $this->getContact()->phone,
        ]);
    }


    private function addButton()
    {
        if ($this->getBot()->getOptions()->vacancyBotFinaleUrl) {
            $text = $this->getBot()->getOptions()->vacancyBotFinaleText;
            $url = $this->getBot()->getOptions()->vacancyBotFinaleUrl;

            $this->getBot()->setInlineKeyboardMarkup([
                [['text' => $text, 'url' => $url]]
            ]);
        }
    }
}