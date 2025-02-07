nginx:
	docker exec -it todoapp_nginx bash
php:
	docker exec -it todoapp_php bash
mysql:
	docker exec -it todoapp_mysql bash
phpmyadmin:
	docker exec -it todoapp_myadmin bash
node:
	docker exec -it todoapp_node bash
tinker:
	docker exec -it todoapp_php php artisan tinker
