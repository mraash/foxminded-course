# install composer packages
packages:
	docker run --rm -it -v "$(PWD):/app" composer/composer install


server-up:
	docker-compose up -d

server-down:
	docker-compose down


phpunit:
	docker-compose run web php vendor/bin/phpunit

phpstan:
	docker-compose run web php vendor/bin/phpstan

phpcs:
	docker-compose run web php vendor/bin/phpcs
