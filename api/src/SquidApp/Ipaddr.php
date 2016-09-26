<?php

namespace SquidApp;
use Exception;

class Ipaddr {

  private $address;
  private $port;

  function __construct($address = '', $port = '') {
      $this->address = $address;
      $this->port    = $port;
  }

  public function setAddress($ip) {
  	
  	if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
             $this->address = $ip;
	} else {
             throw new Exception($ip . ' ' . 'is not a valid IP address');
	}

  }

  public function getAddress() {
	  
      return $this->address;
  } 

  public function checkPort($port) {


  }

  public function getPort() {

      return $this->port;
  }

}
