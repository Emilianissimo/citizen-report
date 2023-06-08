start:
	docker-compose up -d
down:
	docker-compose down
stop:
	docker-compose stop
build:
	docker-compose up --build
mysql-bash:
	docker exec -it ds_citizen_mysql bash
php-bash:
	docker exec -it ds_citizen_php bash
nginx-bash:
	docker exec -it ds_citizen_nginx bash
migrate:
	docker exec -it ds_citizen_php php artisan migrate
