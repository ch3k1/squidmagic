<?php

namespace SquidApp;
use GeoIp2\Database\Reader;
use SquidApp\Core\Database;

class Insert 
{

	const ipDb = 'GeoLite2-Country.mmdb';

    /**
     * @param $ipAddress
     * @return mixed
     * Check Duplicate Records
     */
	static public function checkDuplicate($ipAddress) {

        $checkDuplicate = Database::getRow("SELECT id FROM squidmagic_c2c WHERE ipaddress = ?", $ipAddress);
		return $checkDuplicate;
	}

    /**
     * @param $entry
     * @return mixed
     * check if ip address is valid
     */
	static public function checkIpAddress($entry) {

		$entryData = json_decode($entry, true);
		if(filter_var($entryData['host'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
             return $entryData['host'];
        }
	}

    /**
     * @param $entry
     * @param $ipAddress
     * This function create's records into the DB
     */
	static public function createFlow($entry, $ipAddress) {

		$entryData = json_decode($entry, true);
		$reader    = new Reader(self::ipDb);
		$record    = $reader->country($ipAddress);
		$isoCode   = $record->country->isoCode;

        $data = array(
            "ipaddress"  => $ipAddress,
            "squid"      => $entryData['squidmagic'],
            "status"     => $entryData['status'],
            "country"    => $isoCode,
        );

        Database::insert('squidmagic_c2c', $data, null);
	}
}