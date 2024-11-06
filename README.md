docker compose build <br>
docker compose up <br>
docker exec -it app sh -c "composer install && php artisan migrate --seed" <br>
