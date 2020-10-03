<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();
 
if (isset($_GET['temp']) && isset($_GET['humidity']) && isset($_GET['pressure'])) {
 
    $temp = $_GET['temp'];
    $humidity = $_GET['humidity'];
    $pressure = $_GET['pressure'];

    date_default_timezone_set('Asia/Colombo');
    $date = date("Y-m-d G:i:s");
 
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

 
    $db = new DB_CONNECT();
 
    $result = mysql_query("INSERT INTO weather(temp,humidity,pressure,date) VALUES('$temp','$humidity','$pressure','$date')");
 
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Weather successfully created.";
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
    echo json_encode($response);
}
?>