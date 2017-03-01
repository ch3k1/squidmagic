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
            throw new \SquidApp\Exception\ServerFolderNotFoundException('Server Folder Not found');
	    }

	}

	public static function fileExists($path) {

		// Checks if file exists in certain location 
		$fileExists = file_exists($path);
	    if($fileExists === false) {
            throw new \SquidApp\Exception\FileExistsException('Collector File Not found');
	    }

	}

	public static function openInBackground($path) {

		$Collector = $path.self::Collector;
		$command = "php $Collector";

		shell_exec($command);
	}
}