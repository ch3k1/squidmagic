<?php

namespace SquidApp;
use Exception;

class Ipaddr {

  private $address;

  function __construct($address = '') {
      $this->address = $address;
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

}
