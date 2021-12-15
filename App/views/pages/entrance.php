<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <title>Вход</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/main/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container container-center">
            <form method="post" action="?" class="form-ajax">
                <h2>Вход</h2>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required="">                    
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required="">
                </div>

                <div class="form__bottom">
                    <button type="submit" class="btn btn-primary">Войти</button>
                    <a href="/registration.php">Зарегистрироваться</a>
                    <input type="hidden" name="entrance" value="1">
                </div>

                <div id="message"><?= $message; ?></div>
            </form>
        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="/assets/main/js/script.js"></script> 
</html>