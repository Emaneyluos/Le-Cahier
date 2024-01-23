DOCKER = docker

DOCKER_EXEC = $(DOCKER) exec -it
# Executables (local)
DOCKER_COMP = $(DOCKER) compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP) bin/console

# Misc
.DEFAULT_GOAL = help
.PHONY        : help build up start down logs sh composer vendor sf cc

## —— 🎵 🐳 The Symfony Docker Makefile 🐳 🎵 ——————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
build: ## Builds the Docker images
	@$(DOCKER_COMP) build --pull --no-cache

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

start: build up ## Build and start the containers

down: ## Stop the docker hub
	@$(DOCKER_COMP) down --remove-orphans

logs: ## Show live logs
	@$(DOCKER_COMP) logs --tail=0 --follow

sh: ## Connect to the PHP FPM container
	@$(PHP_CONT) sh

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)

vendor: ## Install vendors according to the current composer.lock file
vendor: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor: composer

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————
sf: ## List all Symfony commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(SYMFONY) $(c)

cc: c=c:c ## Clear the cache
cc: sf

php:  ## List all php commands or pass the parameter "c=" to run a given command, example: make php c=bin/phpunit
	@$(eval c ?=)
	@$(PHP) $(c)

## —— Testing 🧪 ———————————————————————————————————————————————————————————————
testing: unit phpcs phpstan

unit: ## Lunch unit tests
	@$(eval c ?=)
	@$(PHP) $(c) bin/phpunit

phpcs: ## Lunch PHPCodeSniffer. It detect violations of a defined coding standard PSR12
	@$(eval c ?=)
	@$(PHP) $(c) vendor/squizlabs/php_codesniffer/bin/phpcs src/ tests/

phpcbf: ## Lunch PHPCBF. It's a script for automatically correct coding standard violations 
	@$(eval c ?=)
	@$(PHP) $(c) vendor/squizlabs/php_codesniffer/bin/phpcbf src/ tests/

phpstan:
	@$(eval c ?=)
	@$(PHP) $(c) vendor/bin/phpstan analyse


## —— Database 💾 ———————————————————————————————————————————————————————————————
db: ## Access to the CLI of the database
	@$(DOCKER_EXEC) le-cahier-database-1 psql -U app -d app

