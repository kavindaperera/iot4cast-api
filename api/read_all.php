<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$response = array();
 
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");

$db = new DB_CONNECT();	
 
$result = mysql_query("SELECT *FROM weather") or die(mysql_error());
 
if (mysql_num_rows($result) > 0) {
    
    $response["weather"] = array();
 
    while ($row = mysql_fetch_array($result)) {
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