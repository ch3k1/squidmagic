<?php

namespace SquidApp\Core;

require dirname(__DIR__) . '/lib/vendor/autoload.php';

$banner = new \SquidApp\Squid();
$squidmagic = new FileSystem();

// output banner
echo $banner->bannerAction();

// Scans a directory for files
$squidmagic->scandirs('squidmagic/Collector path');

// Checks if file exists in certain location 
$squidmagic->fileExists('Collector Path/server.php');

// run server
$squidmagic->openInBackground('Collector Path/lib/bin/');
