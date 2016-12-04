<?php

namespace SquidApp;

use GeoIp2\Database\Reader;

/**
*  inserting collected data  
*/

class Insert 
{
	public $conn;
	
	public function __construct()
	{
		$this->conn = new Database();
	}

	public function createFlow($entry) {
     
        $conn = $this->conn->getConnection();
		$entryData = json_decode($entry, true);
		$reader = new Reader('../../lib/GeoIP/GeoLite2-Country.mmdb');
		$record = $reader->country($entryData["host"]);
		$isoCode = $record->country->isoCode;

		if($this->conn->getConnection()) {

            $query = "INSERT INTO
                    squidmagic_c2c
                SET
                    ipaddress = ?, squid = ?, status = ?, country = ?";

	        $stmt = $conn->prepare($query); 
	        // bind values
	        $stmt->bindParam(1, $entryData['host']);
	        $stmt->bindParam(2, $entryData['squidmagic']);
	        $stmt->bindParam(3, $entryData['status']);
	        $stmt->bindParam(4, $isoCode);
	 
	        if($stmt->execute()){
	            return true;
	        }
		}
	}
}