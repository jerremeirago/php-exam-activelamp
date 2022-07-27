# docker build
docker-compose up -d --build

# composer
composer install

# mysql
docker exec -i mysql_exam mysql -uroot -proot -e "CREATE DATABASE activelamp_exam char set utf8 collate utf8_general_ci"

# laravel
php artisan down
php artisan key:generate
php artisan migrate:fresh
php artisan up 
