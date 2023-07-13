<?php

namespace app\common\bots\vacancy\commands;

use app\common\bots\vacancy\constants\VacancyBotConst;
use app\common\bots\vacancy\entities\Contact;


class StartCommand extends Command
{
    public function run(): void
    {
        $contact = $this->getContact();

        if ($contact) {
            $userName = $contact->name;
            $contact->update(['step' => VacancyBotConst::STEP_ENTER_NAME,]);
        } else {
            $userName = '';

            Contact::repository()->create([
                'id' => $this->getUserId(),
                'step' => VacancyBotConst::STEP_ENTER_NAME,
            ]);
        }

        $this->getBot()->sendMessage($this->getUserId(), VacancyBotConst::STEP_ENTER_NAME, null, [
            'userName' => $userName,
        ]);
    }
}