# PHATOLOGY-REPORT
docker-compose exec app chmod -R 777 /var/www/storage/framework/views <br>
docker-compose exec app php artisan route:clear <br>
docker-compose exec app php artisan config:clear <br>
docker-compose exec app php artisan view:clear <br>