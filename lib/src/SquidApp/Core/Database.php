<?php

namespace SquidApp\Core;

class Database {

    /**
     * Here we store login credentials and perhas something more in the future. This is filled when connect is called.
     * variable is divided in read and write parts, since there can be two databases simultaneously. One for reading, other for writing
     */
    static protected $accessParams = array();

    /**
     * This holds list of database instance that are connected
     */
    static protected $connected = array();

    /**
     * This will hold both connection objects (instances of PDO).
     */
    static protected $con = array();

    /**
     * Mysql Port
     */
    const port = 3306;

    protected function ensureConnected($accessType) {

        $db_section = parse_ini_file("Config/Conf.ini");
        //if is in connected array, means connection is made. nothing to do here
        if (in_array($accessType, self::$connected)) return;

        //now we create a new PDO object through PDOWrapper.
        self::$con[$accessType] = new PDOWrapper("mysql:host={$db_section['host']}; dbname={$db_section['database']}; port={self::port}", $db_section['user'], $db_section['password']);

        //make so that every error throws an exception
        self::$con[$accessType]->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //add this to list of connections
        self::$connected[] = $accessType;

    }

    static public function getRow($query, $values = array(), $cached=false, $columns=array(), $accessType='read') {

        //make sure is connected
        self::ensureConnected($accessType);

        //get list of rows based on query
        $rows = self::getRows($query, $values, $accessType);

        //if for some reason rows is false (error) or results are zero,
        //return false to client
        if (!$rows || sizeof($rows) == 0)
            return false;

        //else return the first from rows
        return $rows[0];

    }

    protected function getRows($query, $values = array(), $accessType = 'read') {

        //make sure is connected
        self::ensureConnected($accessType);
        //if values is not an array, then make an array and put that value in it.
        if (!is_array($values))
            $values = array($values);

        //here we prepare query based on PDO needs
        $prepared = self::$con[$accessType]->prepare($query);

        //here we execute by passing the values to put instead of ? marks
        $prepared->execute($values);

        //here we get list of rows matched. Not the associative array flag.
        //that is our method of choice
        $rows = $prepared->fetchAll(\PDO::FETCH_ASSOC);

        //now return rows to whoever asked
        return $rows;

    }

    static public function insert($tableName, $data, $invalidateCache = true, $accessType='write') {

        //make sure is connected
        self::ensureConnected($accessType);

        //here we combine column names with comas between them
        //now its like 'name,surname,persCode'
        $columnNamesJoined = "`".implode("`,`", array_keys($data))."`";

        //here we do about the same for data, however instead of values themselves, we put question marks.
        //so now its like (?,?,?);
        $questionMarksJoined = implode(",", array_fill(0,sizeof($data),"?"));

        //here we strip the associative keys from array and name it values
        $values = array_values($data);

        //here we set up the query for inserting
        $query = "insert into $tableName ($columnNamesJoined) values ($questionMarksJoined)";

        //prepare the query. Notice the write label
        $prepared = self::$con[$accessType]->prepare($query);

        //execute the query with values. Now data is being inserted
        $prepared->execute($values);

    }

}