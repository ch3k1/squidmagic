<?php

namespace SquidApp;

require dirname(__DIR__) . '/../vendor/autoload.php';

$port = new Port();

if ($argc !== 2) {
    echo "Usage: php app.php [port].\n";
    exit(1);
}

$portnum = $argv[1];

$port->checkPort($portnum);
print_r($port->getPort() . PHP_EOL);
