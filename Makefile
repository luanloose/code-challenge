green=\033[0;32m
no_color=\033[0m

app=app.code-challenge

up:
	@ docker-compose up -d
	@ echo "\n$(green)Dependencies are up$(no_color)\n\n"

recreate:
	@ docker-compose up -d --force-recreate --build
	@ echo "\n$(green)Dependencies are recreate$(no_color)\n\n"

down:
	@ docker-compose down
	@ echo "\n$(green)Dependencies are down$(no_color)\n\n"

composer:
	@ docker exec -it $(app) composer install
	@ echo "\n$(green)Composer installed$(no_color)\n\n"

phpunit:
	@ docker exec -it $(app) vendor/bin/phpunit --testdox --coverage-html ./_reports/coverage/ ./tests

phpunit-filter:
	@ docker exec -it $(app) vendor/bin/phpunit --testdox --coverage-html ./storage/_reports/coverage/ --filter $(filter-out $@,$(MAKECMDGOALS)) ./tests

bash:
	@ docker-compose up -d
	@ docker exec -it $(app) sh

php:
	@ docker-compose up -d
	@ docker exec -it $(app) php bash

run:
	@ docker exec -it $(app) php index.php