<?php
namespace SquidApp\Core;

require dirname(__DIR__) . '/lib/vendor/autoload.php';
use \SquidApp\Squid;
use \SquidApp\Core\FileSystem;

// output banner
echo Squid::bannerAction();

// Scans a directory for files
FileSystem::scandirs(__DIR__.'/bin');

// Checks if file exists in certain location 
FileSystem::fileExists(__DIR__.'/bin/server.php');

// run server
FileSystem::openInBackground(__DIR__.'/bin/');
