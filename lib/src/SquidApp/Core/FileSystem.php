<?php

namespace SquidApp\Core;
use \SquidApp\Exception\ServerFolderNotFoundException;
use \SquidApp\Exception\FileExistsException;

class FileSystem
{

	const Collector = 'server.php';
	
	public static function scandirs($path) {

		// Scans a directory for files
	    try { 
	    	$scandir = scandir($path);
		    if($scandir === false) {
	            throw new ServerFolderNotFoundException('Server Folder Not found');
		    }
		}
		catch (ServerFolderNotFoundException $e) {
                throw new ServerFolderNotFoundException($e->getMessage());
        }
	    
	}

	public static function fileExists($path) {

		// Checks if file exists in certain location 
		try { 
			$fileExists = file_exists($path);
		    if($fileExists === false) {
	            throw new FileExistsException('Collector File Not found');
		    }
		}
		catch (FileExistsException $e) {
                throw new FileExistsException($e->getMessage());
        }
	    
	}

    /**
     * @param $path
     * Function opens a script in background. It is set up that if you call script like this
     * php index.php a/b...
     */
	public static function openInBackground($path) {

		$Collector = $path.self::Collector;
		$command = "php $Collector";

		shell_exec($command);
	}
}