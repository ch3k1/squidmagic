<?php

namespace SquidApp;

class Database {
 
    // Database connection
    public function getConnection() {

        $db_section = parse_ini_file("Config/Conf.ini");

        $this->conn = null;
 
        try{
            $this->conn = new \PDO("mysql:host=" . $db_section['host'] . ";dbname=" . $db_section['database'], $db_section['user'], $db_section['password']);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
