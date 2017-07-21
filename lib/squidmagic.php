<?php

namespace SquidApp\Core;
use \SquidApp\Squid;

require dirname(__DIR__) . '/lib/vendor/autoload.php';

$squidmagic = new FileSystem();

// output banner
echo Squid::bannerAction();

// Scans a directory for files
$squidmagic->scandirs(__DIR__.'/bin');

// Checks if file exists in certain location 
$squidmagic->fileExists(__DIR__.'/bin/server.php');

// run server
$squidmagic->openInBackground(__DIR__.'/bin/');
