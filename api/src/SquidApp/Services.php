<?php

namespace SquidApp;

/**
*  check with service name
*/

class Services
{
	public $service;
	
	function __construct($service = '')
	{
		$this->service = $service;
	}

	public function detectService($service) {

		  $services = array(80 => 'http', 21 => 'ftp', 22 => 'ssh');
          $port = array_search($service, $services);

          if($port !== NULL) {
          	  $this->service = $port;
          }
	}

	public function getServiceName() {
		  return $this->service;
	}
}
