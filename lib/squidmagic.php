<?php

namespace SquidApp\Core;

require dirname(__DIR__) . '/lib/vendor/autoload.php';

$banner = new \SquidApp\Squid();
$squidmagic = new FileSystem();

// output banner
echo $banner->bannerAction();

// Scans a directory for files
$squidmagic->scandirs('/home/cheki/squidmagic/lib/bin');

// Checks if file exists in certain location 
$squidmagic->fileExists('/home/cheki/squidmagic/lib/bin/server.php');

// run server
$squidmagic->openInBackground('/home/cheki/squidmagic/lib/bin/');
