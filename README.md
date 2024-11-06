docker compose build <br>
docker compose up <br>
docker exec -it app_container sh -c "composer install && php artisan migrate --seed" <br>
