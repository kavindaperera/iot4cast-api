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
        
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error($con));
 
        $db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error($con)) or die(mysqli_error($con));
 
        return $con;
    }
 
	// Function to close the database
    function close() {
        mysqli_close();
    }
 
}
 
?>