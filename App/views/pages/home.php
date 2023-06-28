<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <title>Главная</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/assets/main/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container home px-4 py-5">
            <h2 class="pb-2 border-bottom">
                Спасибо что вошли, <?= $user->getEmail(); ?> <small>(<?= $user->getRole(); ?>)</small>
                <a href="/?page=logout">Выйти</a>
            </h2>

            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 buttons">
                <?php foreach ($roles as $key => $role) : ?>
                    <div class="col">
                        <button 
                            type="button" 
                            data-level="<?= $role['level']; ?>"
                            class="btn btn-danger btn-sm load_post"
                            
                            <?php if (!$user->can($role['level'])) : ?>
                                disabled=""
                            <?php endif; ?>

                        >Кнопка <?= $key; ?></button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="posts" class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <?php
                    if ($posts) {
                        foreach ($posts as $post) {
                            App\Services\RenderService::template('parts/post', [
                                'post' => $post,
                            ]);
                        }
                    }                    
                ?>
            </div>

            <div id="placeholder">
                <?php App\Services\RenderService::template('parts/post'); ?>
            </div>

            <div class="g-4 py-5">
                <button 
                    id="save_all_posts" 
                    type="button" 
                    class="btn btn-primary" 
                    disabled=""
                >Сохранить все записи</button>
            </div>

            <div id="message" class="p-3 mb-3 " data-sus="Все записи сохранены."></div>
        </div>
    </body>

    <script>
        document.number = <?= isset($post['id']) ? $post['id'] + 1 : 1; ?>;
        document.placeholderUrl = 'http://jsonplaceholder.typicode.com/posts/';
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="/public/assets/main/js/script.js"></script>
</html>