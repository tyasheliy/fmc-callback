run:
	composer install
	php artisan test
	php artisan sail:install
	./vendor/bin/sail down
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan migrate:refresh --seed
