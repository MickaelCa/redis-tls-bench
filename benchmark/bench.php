<?php

require 'vendor/autoload.php';

$redisConfig = [
    'scheme' => 'tcp',
    'host'   => 'redis',
    'port'   => 6379,
];

$redisTlsConfig = [
    'scheme' => 'tls',
    'host'   => 'redis-tls',
    'port'   => 6379,
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'local_cert' => '/tls/client.crt',       // path to your client certificate
        'local_pk' => '/tls/client.key',         // path to your client private key
    ],
];

$clientRedis = new Predis\Client($redisConfig);
$clientRedisTls = new Predis\Client($redisTlsConfig);

$iterations = 10000;

$start = microtime(true);
for ($i = 0; $i < $iterations; $i++) {
    $clientRedis->set("testkey_$i", 'value');
    $clientRedis->get("testkey_$i");
}
$end = microtime(true);
$durationRedis = $end - $start;

$start = microtime(true);
for ($i = 0; $i < $iterations; $i++) {
    $clientRedisTls->set("testkey_$i", 'value');
    $clientRedisTls->get("testkey_$i");
}
$end = microtime(true);
$durationRedisTls = $end - $start;

echo "Time taken for Redis without TLS: $durationRedis seconds\n";
echo "Time taken for Redis with TLS: $durationRedisTls seconds\n";

if ($durationRedis < $durationRedisTls) {
    $diff = ($durationRedisTls - $durationRedis) / $durationRedis * 100;
    echo "Redis without TLS is faster by " . round($diff, 2) . "%\n";
} else {
    $diff = ($durationRedis - $durationRedisTls) / $durationRedisTls * 100;
    echo "Redis with TLS is faster by " . round($diff, 2) . "%\n";
}
