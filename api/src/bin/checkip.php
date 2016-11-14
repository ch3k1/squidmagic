<?php

namespace SquidApp;

require dirname(__DIR__) . '/../vendor/autoload.php';

$ipaddr = new Ipaddr();

if ($argc !== 2) {
    echo "Usage: php app.php [ipaddress].\n";
    exit(1);
}

$ip = $argv[1];

$ipaddr->setAddress($ip);
print_r($ipaddr->getAddress() . PHP_EOL);

