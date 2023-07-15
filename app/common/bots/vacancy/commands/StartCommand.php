<?php

namespace app\common\bots\vacancy\commands;

use app\common\bots\vacancy\constants\VacancyBotConst;
use app\common\bots\vacancy\entities\Contact;


class StartCommand extends Command
{
    public function run(): void
    {
        $chat = $this->getMessage()->getChat();

        $userName = trim($chat->getFirstName() . ' ' . $chat->getLastName());

        if ($this->getContact()) {
            $this->getContact()->update([
                'step' => VacancyBotConst::STEP_ENTER_NAME,
                'name' => null,
                'phone' => null,
            ]);
        } else {
            Contact::repository()->create([
                'id' => $this->getUserId(),
                'step' => VacancyBotConst::STEP_ENTER_NAME,
                'status' => VacancyBotConst::CONTACT_STATUS_NEW
            ]);
        }

        if ($userName) {
            $this->getBot()->setReplyKeyboardMarkup(
                [[['text' => $userName]]]
            );
        }

        $this->getBot()->sendMessage($this->getUserId(), VacancyBotConst::STEP_ENTER_NAME, null, [
            'userName' => $userName,
        ]);
    }
}