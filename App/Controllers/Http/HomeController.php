<?php

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

        $this->redirect('/?page=entrance');
    }
}