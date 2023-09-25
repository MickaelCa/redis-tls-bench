how to run :

docker compose --profile bench build
docker compose up -d
docker compose --profile bench run --rm php bash
php /benchmark/bench.php