<?php

namespace SquidApp;

class Ipaddr {

  private $address;

  function __construct($address = '') {
      $this->address = $address;
  }

  public function setAddress($ip) {
  	
  	if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
          $this->address = $ip;
	} else {
          echo json_encode(array('status' => $ip . ' ' . 'is not a valid IP address')) .PHP_EOL;
	}
  }

  public function getAddress() {
      return $this->address;
  } 

}
