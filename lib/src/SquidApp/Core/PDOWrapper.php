<?php

namespace SquidApp\Core;
/**
 * Main intension for this class is so that we can unit test DB class by mocking PDOWrapper. Obviously we can't mock PDO itself
 *
 */
class PDOWrapper {

    /*################################################### PROTECTED PROPERTIES ###################################################*/

    /* @var PDO ths holds instance of actual connection */
    protected $pdo = null;

    /*#################################################### PUBLIC FUNCTIONS ####################################################*/

    /**
     * when PDOWrapper is created, also create PDO object and keep it in class variable
     *
     * @param string $connString something like 'host=1.2.3.4, database=abc'. passed directly to PDO
     * @param string $user name of user
     * @param string $pass the password string
     * @return void
     */
    public function __construct($connString, $user, $pass) {

        //create the pdo and keep it
        $this->pdo = new \PDO($connString, $user, $pass);

    }

    /*################################################### PROTECTED FUNCTIONS ###################################################*/

    /**
     * Now we mock the prepare function, since it is taken from pdo. in contrast to execute function, which resides in statement
     *
     * @param string $query query to execute
     * @return Statement
     */
    public function prepare($query) {

        //return the pdo statement
        return $this->pdo->prepare($query);

    }

    /**
     * This forwards the setAttribute method
     *
     * @param mixed $attributeName mixed
     * @param mixed $attributeValue mixed
     * @return void
     */
    public function setAttribute($attributeName, $attributeValue) {

        //forward the function
        $this->pdo->setAttribute($attributeName, $attributeValue);

    }

}
