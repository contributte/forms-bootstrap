.PHONY: qa lint cs csf phpstan tests coverage

all:
	@$(MAKE) -pRrq -f $(lastword $(MAKEFILE_LIST)) : 2>/dev/null | awk -v RS= -F: '/^# File/,/^# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$' | xargs

vendor: composer.json composer.lock
	composer install

qa: lint phpstan cs

lint: vendor
	vendor/bin/linter src tests

cs: vendor
	vendor/bin/codesniffer src tests

csf: vendor
	vendor/bin/codefixer src tests

phpstan: vendor
	vendor/bin/phpstan analyse -l 7 -c phpstan.neon src

tests: vendor
	vendor/bin/phpunit

coverage: vendor
	vendor/bin/phpunit --coverage-clover=tests/coverage.xml
