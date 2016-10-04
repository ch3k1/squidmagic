<?php

namespace SquidApp;

class Database {
 
    private $host = "localhost";
    private $db_name = "netflow";
    private $username = "root";
    private $password = "12345678";
    public $conn;
 
    // db connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
