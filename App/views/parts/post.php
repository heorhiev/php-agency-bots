<div class="col post">
    <div class="feature">
        <h3 class="title"><?= isset($post['title']) ? $post['title'] : ''; ?></h3>
        <p class="content"><?= isset($post['content']) ? $post['content'] : ''; ?></p>
        <p class="detail">
            Button: <span class="button"><?= isset($post['button']) ? $post['button'] : ''; ?></span>
        </p>
    </div>
</div>