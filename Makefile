.PHONY: help install build up down composer console phpunit yarn gulp clean
.DEFAULT_GOAL := help

help: ## Output usage documentation
	@echo "Usage: make COMMAND [-a=\"command args\"]\n\nCommands:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

install: ## Install dependencies
	make build
	make composer a=install
	make yarn a=install
	make gulp a="build --production"

build: ## Build Docker images
	docker-compose -f .docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml build --force-rm

up: ## Get up and running
	docker-compose -f .docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml up -d --force-recreate

down: ## Shut down running containers
	docker-compose -f .docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml down

composer: ## Run Composer command
	docker-compose -f ./.docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml run --rm app composer $(a)

console: ## Run Symfony console command
	docker-compose -f ./.docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml run -u www-data --rm app bin/console $(a)

phpunit: ## Run PHPunit command
	docker-compose -f ./.docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml run --rm app ./vendor/bin/simple-phpunit $(a)

yarn: ## Run Yarn command
	docker-compose -f ./.docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml -f ./.docker/docker-compose.node.yml run --rm node yarn $(a)

gulp: ## Run Gulp command
	docker-compose -f ./.docker/docker-compose.yml -f ./.docker/docker-compose.dev.yml -f ./.docker/docker-compose.node.yml run --rm node ./node_modules/.bin/gulp $(a)

clean: ## Removes all build files and folders except configuration
	rm -rf var/cache/* var/bootstrap.php.cache var/sessions/* var/logs/* web/assets web/bundles web/android-* web/apple-* web/browserconfig.xml web/coast-228x228.png web/favicon* web/firefox* web/manifest* web/mstile* web/yandex* node_modules vendor
