phinx migrate -e development
composer install
php -S 0.0.0.0:8888 -t public