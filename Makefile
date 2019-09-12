CURRENT_DIR=$(patsubst %/,%,$(dir $(realpath $(firstword $(MAKEFILE_LIST)))))

.PHONY: test test-cs test-quality test-unit cs-fix

test: test-cs test-quality test-unit

test-quality: ./vendor
	./vendor/bin/phpstan analyse -l max .

test-unit: ./vendor
	./vendor/bin/phpunit --stop-on-failure

cs-fix: ./vendor
    ./vendor/bin/php-cs-fixer fix --config=.php_cs -v

 ./vendor: ./composer.lock
	composer install

./composer.lock: ./composer.json
	composer update
	touch ./composer.lock
