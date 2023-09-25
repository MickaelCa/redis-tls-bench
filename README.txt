how to run :

docker compose --profile bench build
docker compose up -d
docker compose --profile bench run --rm php bash
composer install
php /benchmark/bench.php