<?php

namespace app\common\modules\vacancy\repository;

use app\common\components\repository\Repository;
use app\common\modules\contacts\Contact;


class ContactsRepository extends Repository
{

    public static function tableName(): string
    {
        return 'vacancy_contact';
    }


    public static function entityClassName(): string
    {
        return Contact::class;
    }
}