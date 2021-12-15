<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <title>Регистрация</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/main/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container container-center">
            <form method="post" action="?" class="form-ajax">
                <h2>Регистрация</h2>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="6" required="">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="6" required="">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Должность</label>
                    <select id="role" name="role" class="form-select" required="">
                        <option value="">Выберите должность из списка</option>

                        <?php foreach ($roles as $key => $role) : ?>
                            <option value="<?= $key; ?>"><?= $role['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form__bottom">
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    <a href="/entrance.php">Войти</a>
                    <input type="hidden" name="registration" value="1">
                </div>

                <div id="message"><?= $message; ?></div>
            </form>
        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="/assets/main/js/script.js"></script> 
</html>