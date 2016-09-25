<?php

namespace SquidApp;

require dirname(__DIR__) . '/../vendor/autoload.php';
$pusher = new Ipaddr();

if ($argc !== 2) {
    echo "Usage: php app.php [ipaddress].\n";
    exit(1);
}
$ip = $argv[1];

$pusher->setAddress($ip);
print_r($pusher->getAddress() . PHP_EOL);
