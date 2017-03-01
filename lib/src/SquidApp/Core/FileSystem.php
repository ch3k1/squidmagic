<?php

namespace SquidApp\Core;

/**
*  run Collector
*/
class FileSystem
{

	const Collector = 'server.php';
	
	public static function scandirs($path) {

		// Scans a directory for files
	    $scandir = scandir($path);
	    if($scandir === false) {
	    	try {
                throw new \SquidApp\Exception\ServerFolderNotFoundException('Server Folder Not found');
			} catch (\SquidApp\Exception\ServerFolderNotFoundException $e) {
				echo 'Caught exception: ' . $e->getMessage() . "\n";
			}
	    }

	}

	public static function fileExists($path) {

		// Checks if file exists in certain location 
		$fileExists = file_exists($path);
	    if($fileExists === false) {
	    	try {
                throw new \SquidApp\Exception\FileExistsException('Collector File Not found');
			} catch (\SquidApp\Exception\FileExistsException $e) {
				echo 'Caught exception: ' . $e->getMessage() . "\n";
			}
	    }

	}

	public static function openInBackground($path) {

		$Collector = $path.self::Collector;
		$command = "php $Collector";

		shell_exec($command);
	}
}