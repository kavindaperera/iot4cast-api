<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$response = array();
 
$filepath = realpath (dirname(__FILE__));

require_once($filepath."/dbconfig.php");
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db = mysqli_select_db($connection,DB_DATABASE);
 
$result = mysqli_query($connection,"SELECT *FROM weather") or die(mysqli_error($connection));
 
if (mysqli_num_rows($result) > 0) {
    
    $response["weather"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        $weather = array();
        $weather["id"] = $row["id"];
        $weather["temp"] = $row["temp"];
        $weather["humidity"] = $row["humidity"];
        $weather["pressure"] = $row["pressure"];
        $weather["light"] = $row["light"];
		$weather["date"] = $row["date"];
        

        array_push($response["weather"], $weather);
    }
    $response["success"] = 1;
 
    echo json_encode($response);
}	
else 
{
	$response["success"] = 0;
    $response["message"] = "No data on weather found";
 
    echo json_encode($response);
}
?>