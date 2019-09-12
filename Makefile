CURRENT_DIR=$(patsubst %/,%,$(dir $(realpath $(firstword $(MAKEFILE_LIST)))))

.PHONY: test test-cs test-quality test-unit
test: test-cs test-quality test-unit

test-quality: ./vendor
	./vendor/bin/phpstan analyse -l max .

test-unit: ./vendor
	./vendor/bin/phpunit --cache-result --order-by defects --stop-on-failure

 ./vendor: ./composer.lock
	composer install

./composer.lock: ./composer.json
	composer update
	touch ./composer.lock
