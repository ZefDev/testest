docker compose build
docker compose up
docker exec -it app sh -c "composer install && php artisan migrate --seed"
