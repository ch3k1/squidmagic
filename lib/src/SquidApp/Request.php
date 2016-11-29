<?php

namespace SquidApp;

/**
* Gets client Address.
*/
class Request
{
	public $address;
	
	public function __construct($address = null)
	{
		$this->address = $address;
	}

	public function getClientAddress()
	{
	  $this->address = isset($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:gethostbyname(gethostname());
      return $this->address;
	}
}
