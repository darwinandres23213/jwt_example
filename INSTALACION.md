
composer install

composer require php-open-source-saver/jwt-auth
copy .env.example .env
php artisan key:generate

Copy-Item .env.example .env
php artisan key:generate

php artisan jwt:secret
