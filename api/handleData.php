<?php

if( $_POST["xml"]) {
    
    $cap_xml = $_POST["xml"];
    $myfile = fopen("cap_data.xml", "w");
    fwrite($myfile, $cap_xml);
    fclose($myfile);

    $capdata = simplexml_load_file("cap_data.xml");

    $temp = $capdata->parameter[0]->value;
    $humidity = $capdata->parameter[1]->value;
    $pressure = $capdata->parameter[2]->value;
    $light = $capdata->parameter[3]->value;

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