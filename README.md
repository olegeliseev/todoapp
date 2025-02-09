# Todo App
Простой список дел на Laravel и Vue.js

## Установка через Docker

Перейдите в папку, в которой хотите поместить проект, и клонируйте репозиторий:

```sh
$ git clone https://github.com/olegeliseev/todoapp.git
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

После чего запустите миграции и сидеры:
```
php artisan migrate
```

Перейдите в контейнер node.js и выполните команду для сборки фронтенда:
```
docker exec -it todoapp_node bash

npm run dev
```

Переименовать файл .env.example в корневой папке в .env
После этого приложение будет доступно по адресу http://localhost:8080

Для запуска Unit тестов перейдите в контейнер приложения и запустите соответсвующую команду:
```
docker exec -it todoapp_php bash

php artisan test
```
