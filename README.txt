how to run :

docker compose --profile bench build
docker compose up -d
docker compose --profile bench run --rm php bash
composer install
php /benchmark/bench.php

-------------------------

Results on a Ryzen 9 5950X :

7614d3e1189d:/benchmark# php bench.php
Time taken for Redis without TLS: 0.48122906684875 seconds
Time taken for Redis with TLS: 0.7732720375061 seconds
Redis without TLS is faster by 60.69%