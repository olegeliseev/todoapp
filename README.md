# Todo App
Простой список задач на Laravel и Vue.js

## Установка через Docker

Перейдите в папку, в которой хотите поместить проект, и клонируйте репозиторий:

```
git clone https://github.com/olegeliseev/todoapp.git
```

Перейдите в корневую папку проекта и выполните команду:

```
docker compose up -d --build
```

Перейдите в контейнер приложения и выполните команду для установки зависимостей:
```
docker exec -it todoapp_php bash

composer install
```

После чего запустите миграции:
```
php artisan migrate
```

Перейдите в контейнер node.js и выполните команды для сборки фронтенда:
```
docker exec -it todoapp_node bash

npm install

npm run dev
```

Переименовать файл .env.example в корневой папке в .env
После этого приложение будет доступно по адресу http://localhost:8080

Для запуска Unit тестов перейдите в контейнер приложения и запустите соответсвующую команду:
```
docker exec -it todoapp_php bash

php artisan test
```

![Image Alt](https://github.com/olegeliseev/todoapp/blob/f1f99a99226d463677c62b43c742ee9f118253db/screenshot.png)
