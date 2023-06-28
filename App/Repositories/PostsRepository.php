<?php

namespace App\Repositories;

use App\Entities\PostEntity;
use App\Services\DBService;


class PostsRepository extends Repository
{
    public static function getPosts(): array
    {
        $st = DBService::getMysqli()->query(
            'SELECT * FROM ' . PostEntity::getTableName()
        );

        return $st->fetch_all(MYSQLI_ASSOC);
    }


    public static function addPost($post): bool
    {
        $st = DBService::getMysqli()->prepare(
            'INSERT INTO ' . PostEntity::getTableName() . '(title, content, user_role, button) VALUES (?, ?, ?, ?)'
        );
        
        $st->bind_param(
            'ssss', 
            $post['title'], $post['content'], $post['user_role'], $post['button']
        );

        return $st->execute();
    }


    public static function addPosts($posts, $user): array
    {
        $results = [];

        foreach ($posts as $post) {

            if (!$user->can($post['level'])) {
                continue;
            }

            $results[] = self::addPost([
                'id' => $post['id'],
                'title' => $post['title'],
                'content' => $post['body'],
                'button' => $post['button'],
                'user_role' => $user->getRole(),
            ]);
        }

        return $results;
    }

}