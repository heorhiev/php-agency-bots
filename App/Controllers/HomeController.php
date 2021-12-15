<?php
/**
 * Контроллер главной
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers;

use App\Entities\UserEntity;
use App\Services\RequestService;
use App\Services\AuthorizationService;
use App\Repositories\PostsRepository;


class HomeController extends Controller {
    
    public function main() {

        $user = AuthorizationService::getAuthUser();

        if ($user) {
            if (RequestService::post('save_all_posts')) {
                // сохранить все записи
                return PostsRepository::addPosts(
                    RequestService::post('posts'),
                    $user
                );
            }
    
            return $this->view('pages/home', [
                'user' => $user,
                'roles' => UserEntity::getRoles(),
                'posts' => PostsRepository::getPosts(),
            ]);
        }

        // редирект если не авторизирован
        $this->redirect('/entrance.php');
    }
}