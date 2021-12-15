# native-app-php

**MVC**
* **/App/Controllers** - namespace контроллеров. К методу main обращается объект Route;
* **/App/Entities** - namespace сущностей. Пользователи и записи;
* **/App/Repositories** - namespace репозитория. Тут SQL запросы к таблацам Users и Posts;
* **/App/Services** - namespace услуг. Валидатор почты, пароля, класс рендированияя и т.д.;
* **/App/views** - шаблоны отображения;


**База данных**
* **Users** - пользователи;
* **Posts** - записи;

В файле databasename.sql дамп базы данных;


**Фронт**

Используется jQuery 3.6, Bootstrap v5.1.

Данные с форм входа и регистрации отправляются аяксом на сервер.
