<?php
/**
 * Файл класса репозитория записей
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Repositories;

use App\Entities\PostEntity;
use App\Services\DBService;


class PostsRepository extends Repository {


    /**
     * Возвращает все записи
     */
    public static function getPosts() {
        $st = DBService::getMysqli()->query(
            'SELECT * FROM ' . PostEntity::getTableName()
        );

        return $st->fetch_all(MYSQLI_ASSOC);
    }


    /**
     * Добавление записи
     */
    public static function addPost($post) {
        $st = DBService::getMysqli()->prepare(
            'INSERT INTO ' . PostEntity::getTableName() . '(title, content, user_role, button) VALUES (?, ?, ?, ?)'
        );
        
        $st->bind_param(
            'ssss', 
            $post['title'], $post['content'], $post['user_role'], $post['button']
        );

        $st->execute();
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

            self::addPost([
                'id' => $post['id'],
                'title' => $post['title'],
                'content' => $post['body'],
                'button' => $post['button'],
                'user_role' => $user->getRole(),
            ]);
        }
    }

}