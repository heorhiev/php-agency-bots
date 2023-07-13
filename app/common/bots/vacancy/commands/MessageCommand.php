<?php

namespace app\common\bots\vacancy\commands;


use app\common\bots\constants\VacancyBotConst;
use app\common\bots\vacancy\NameValidator;
use app\common\components\PhoneValidator;

class MessageCommand extends Command
{
    public function run(): void
    {
        $this->{$this->getContact()->step}();
    }


    public function enterName(): void
    {
        $text = trim($this->getMessage()->getText());

        if ((new NameValidator())->isValid($text)) {
            $this->getContact()->update([
                'name' => $text,
                'step' => VacancyBotConst::STEP_ENTER_PHONE,
            ]);

            $key = VacancyBotConst::STEP_ENTER_PHONE;
        } else {
            $key = $this->getContact()->step . '-error';
        }

        $this->getBot()->sendMessage($this->getUserId(), $key, null, [
            'contact' => $this->getContact(),
        ]);
    }


    public function enterPhone(): void
    {
        $text = trim($this->getMessage()->getText());

        if ((new PhoneValidator())->isValid($text)) {
            $this->getContact()->update([
                'phone' => $text,
                'step' => VacancyBotConst::STEP_FINALE
            ]);

            $key = VacancyBotConst::STEP_FINALE;
        } else {
            $key = $this->getContact()->step . '-error';
        }

        $this->getBot()->sendMessage($this->getUserId(), $key, null, [
            'contact' => $this->getContact(),
        ]);
    }


    public function finale()
    {
        $this->getBot()->sendMessage($this->getUserId(), VacancyBotConst::STEP_FINALE, null, [
            'contact' => $this->getContact(),
        ]);
    }
}