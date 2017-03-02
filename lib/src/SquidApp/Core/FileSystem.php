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
	    try { 
	    	$scandir = scandir($path);
		    if($scandir === false) {
	            throw new \SquidApp\Exception\ServerFolderNotFoundException('Server Folder Not found');
		    }
		}
		catch (\SquidApp\Exception\ServerFolderNotFoundException $e) {
                throw new \SquidApp\Exception\ServerFolderNotFoundException($e->getMessage());
        }
	    
	}

	public static function fileExists($path) {

		// Checks if file exists in certain location 
		try { 
			$fileExists = file_exists($path);
		    if($fileExists === false) {
	            throw new \SquidApp\Exception\FileExistsException('Collector File Not found');
		    }
		}
		catch (\SquidApp\Exception\FileExistsException $e) {
                throw new \SquidApp\Exception\FileExistsException($e->getMessage());
        }
	    
	}

	public static function openInBackground($path) {

		$Collector = $path.self::Collector;
		$command = "php $Collector";

		shell_exec($command);
	}
}