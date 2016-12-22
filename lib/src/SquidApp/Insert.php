<?php

namespace SquidApp;
use GeoIp2\Database\Reader;

/**
*  inserting collected data  
*/
class Insert 
{
	public $conn;
	const GEOIPDB = '../../lib/GeoIP/GeoLite2-Country.mmdb';
	
	public function __construct()
	{
		$this->conn = new Database();
	}

	static public function checkIpaddr($entry) {
		
		$entryData = json_decode($entry, true);
		if(filter_var($entryData['host'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
             return $entryData['host'];
        }
	}

	public function createFlow($entry, $ipaddr) {

        $conn      = $this->conn->getConnection();
		$entryData = json_decode($entry, true);
		$reader    = new Reader(self::GEOIPDB);
		$record    = $reader->country($ipaddr);
		$isoCode   = $record->country->isoCode;
		
		if($this->conn->getConnection()) {
            $query = "INSERT INTO
                    squidmagic_c2c
                SET
                    ipaddress = ?, squid = ?, 
                    status = ?, country = ?";
	        $stmt = $conn->prepare($query); 
	        // bind values
	        $stmt->bindParam(1, $ipaddr);
	        $stmt->bindParam(2, $entryData['squidmagic']);
	        $stmt->bindParam(3, $entryData['status']);
	        $stmt->bindParam(4, $isoCode);
	 
	        if($stmt->execute()){
	             return true;
	        }
		}
	}
}