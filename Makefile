.PHONY: all deps test fixer phpstan
current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.DEFAULT_GOAL := help

all: deps test fixer phpstan ## run all check before commit

build: ## Build the container
	@docker-compose build
	@make deps

deps: ## install dependencies
	docker-compose run --rm php composer install

help: ## Prints this help.
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

fixer: ## run php-cs-fixer
	@docker-compose run --rm php composer run-script fixer

phpstan: ## run phpstan
	@docker-compose run --rm php composer run-script phpstan

sh: ## open sh inside container
	@docker-compose run php sh

test: ## run all tests
	@docker-compose run --rm php composer run-script test

test-mutation: ## run tests with mutation
	@docker-compose run --rm php composer run-script test-mutation

