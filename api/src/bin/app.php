<?php

namespace SquidApp;
require dirname(__DIR__) . '/../vendor/autoload.php';
$pusher = new Ipaddr();

$pusher->setAddress('192.168.0.111');
print_r($pusher->getAddress() . PHP_EOL);

