run:
	composer install
	if [ -e ./vendor/bin/sail ]; then \
		continue; \
	else \
		php artisan sail:install; \
	fi
	php artisan test
	./vendor/bin/sail down
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan migrate:refresh --seed
