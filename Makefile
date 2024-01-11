run:
	if [ -e ./vendor/bin/sail ]; then \
		continue; \
	else \
		php artisan sail:install; \
	fi
	composer install
	php artisan test
	./vendor/bin/sail down
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan migrate:refresh --seed
