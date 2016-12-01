<?php

namespace SquidApp;

/**
*  inserting collected data  
*/
class Insert extends Database
{
	public $conn;
	
	public function __construct()
	{
		$this->conn = new Database();
	}

	public function createFlow($entry) {
        $conn = $this->conn->getConnection();
		$entryData = json_decode($entry, true);
		
		if($this->conn->getConnection()) {

            $query = "INSERT INTO
                    squidmagic_c2c
                SET
                    ipaddress = ?, squid = ?, status = ?";

	        $stmt = $conn->prepare($query); 
	        // bind values
	        $stmt->bindParam(1, $entryData['host']);
	        $stmt->bindParam(2, $entryData['squidmagic']);
	        $stmt->bindParam(3, $entryData['status']);
	 
	        if($stmt->execute()){
	            return true;
	        }
		}
	}
}