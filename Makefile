run:
	composer install
	test -e ./vendor/bin/sail || php artisan sail:install
	php artisan test
	./vendor/bin/sail down
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan migrate:refresh --seed
