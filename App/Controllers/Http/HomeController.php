<?php
/**
 * Контроллер главной
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers\Http;

use App\Entities\UserEntity;
use App\Repositories\PostsRepository;
use App\Services\AuthorizationService;
use App\Services\RequestService;


class HomeController extends Controller
{
    public function main()
    {
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
        $this->redirect('/?page=entrance');
    }
}