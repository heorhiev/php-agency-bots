jQuery.noConflict(); (function ($) {
    $(function () {

        "use strict";

        var $body = $('body'),
            posts = [];


        // загрузка записи
        $body.on('click', '.load_post', function () {
            var $this = $(this);

            $.getJSON(document.placeholderUrl + document.number, function (post) {
                post.button = $this.text();
                post.level = $this.attr('data-level');
                posts.push(post);
                document.number++;

                addPost(post);
            });

            $('#save_all_posts').prop('disabled', false);
        });


        // сохранение
        $body.on('click', '#save_all_posts', function () {
            if (!posts) {
                return false;
            }

            $.ajax({
                'method': 'POST',
                'url': '/',
                'data': {
                    'posts': posts,
                    'save_all_posts': true,
                },
            }).done(function (response) {
                console.log(response);
                var $message = $('#message');

                $message.text($message.attr('data-sus')).show(100);
            });
        });


        // добавление записи в ДОМ
        function addPost(post) {
            var $post = $('#placeholder .post').clone();

            $('.title', $post).text(post.title);
            $('.content', $post).text(post.body);
            $('.button', $post).text(post.button);

            $('#posts').append($post);
        }
    })
})(jQuery);