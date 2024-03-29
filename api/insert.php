<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();
 
if (isset($_GET['temp']) && isset($_GET['humidity']) && isset($_GET['pressure']) && isset($_GET['light'])) {
 
    $temp = $_GET['temp'];
    $humidity = $_GET['humidity'];
    $pressure = $_GET['pressure'];
    $light = $_GET['light'];

    date_default_timezone_set('Asia/Colombo');
    $date = date("Y-m-d G:i:s");
 
    $filepath = realpath (dirname(__FILE__));
 
    require_once($filepath."/dbconfig.php");
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    $db = mysqli_select_db($connection,DB_DATABASE);
 
    $result = mysqli_query($connection,"INSERT INTO weather(temp,humidity,pressure,light,date) VALUES('$temp','$humidity','$pressure','$light','$date')");
 
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