start:
	sudo docker-compose up -d
down:
	sudo docker-compose down
stop:
	sudo docker-compose stop
build:
	sudo docker-compose up --build
mysql-bash:
	sudo docker exec -it ds_citizen_mysql bash
php-bash:
	sudo docker exec -it ds_citizen_php bash
nginx-bash:
	sudo docker exec -it ds_citizen_nginx bash
migrate:
	sudo docker exec -it ds_citizen_php php artisan migrate
setup: 
	sudo docker exec -it ds_citizen_php composer install --prefer-dist
	make migrate

