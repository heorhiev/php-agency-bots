<?php
/**
 * Файл класса архива
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 

use App\Entities\PostEntity;
 

class ArchiveService extends Service {

    /**
     * Возвращает все записи
     */
    public static function getPosts() {
        $st = DBService::getMysqli()->query(
            'SELECT * FROM ' . PostEntity::TABLE
        );

        return $st->fetch_all(MYSQLI_ASSOC);
    }


    /**
     * Добавляет запись
     */
    public static function addPosts($posts, $user) {
        foreach ($posts as $post) {

            if (!$user->can($post['level'])) {
                // проверка на случай, если сняли disable
                continue;
            }

            $postEntity = new PostEntity([
                'id' => $post['id'],
                'title' => $post['title'],
                'content' => $post['body'],
                'button' => $post['button'],
                'user_role' => $user->getRole(),
            ]);

            $postEntity->execute();
        }
    }
}