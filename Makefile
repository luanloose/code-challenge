green=\033[0;32m
no_color=\033[0m

app=app.code-challenge

install:
	@ docker-compose up -d
	@ docker exec -it $(app) composer install
	@ echo "\n$(green)Dependencies are up$(no_color)\n\n"

up:
	@ docker-compose up -d
	@ echo "\n$(green)Dependencies are up$(no_color)\n\n"

recreate:
	@ docker-compose up -d --force-recreate --build
	@ docker exec -it $(app) composer install
	@ echo "\n$(green)Dependencies are recreate$(no_color)\n\n"

down:
	@ docker-compose down
	@ echo "\n$(green)Dependencies are down$(no_color)\n\n"

composer:
	@ docker exec -it $(app) composer install
	@ echo "\n$(green)Composer installed$(no_color)\n\n"

phpunit:
	@ docker exec -it $(app) vendor/bin/phpunit --colors --testdox ./tests

phpunit-filter:
	@ docker exec -it $(app) vendor/bin/phpunit --colors --testdox --filter $(filter-out $@,$(MAKECMDGOALS)) ./tests

phpunit-coverage-text:
	@docker-compose run --rm -v $$(pwd):/app $(app) php ./vendor/bin/phpunit --colors --testdox --coverage-text --whitelist ./src/ ./tests

phpunit-coverage-html:
	@docker-compose run --rm -v $$(pwd):/app $(app) php ./vendor/bin/phpunit --colors --testdox --coverage-html ./coverage --whitelist ./src/ ./tests

bash:
	@ docker-compose up -d
	@ docker exec -it $(app) sh

run:
	@ docker exec -it $(app) php ./src/Infrastructure/Commands/CapitalGains.php

run-file:
	@ docker exec -i $(app) php ./src/Infrastructure/Commands/CapitalGains.php < $(filter-out $@,$(MAKECMDGOALS))