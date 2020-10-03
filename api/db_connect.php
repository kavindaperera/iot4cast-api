<?php

class DB_CONNECT {
 
    // Constructor
    function __construct() {
        $this->connect();
    }
 
    // Destructor
    function __destruct() {
        $this->close();
    }
 
   // Function to connect to the database
    function connect() {

        $filepath = realpath (dirname(__FILE__));

        require_once($filepath."/dbconfig.php");
        
        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
 
        $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
 
        return $con;
    }
 
	// Function to close the database
    function close() {
        mysql_close();
    }
 
}
 
?>