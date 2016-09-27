<?php

namespace SquidApp;
use Exception;

/**
*  check with port
*/
class Port
{
	public $port;
	
	function __construct($port = '')
	{
		$this->port = $port;
	}

	public function checkPort($port) {

       if(isset($port)) {
           $this->port = $port;
       } else {
           throw new Exception($port . ' ' . 'not found');
       }
    }

    public function getPort() {

         return $this->port;
    }
}