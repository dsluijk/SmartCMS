<?php

include("classes/classCombiner.php");

/**
This is the hub of the api, the routing and response are defined here.

Response codes:

Global:
0 = success
1 = No request type defined
2 = CMS not installed
3 = database connection failed

**/

$response = array("code" => "", "content" => "");

if(empty($_POST['type'])) {
    $response["code"] = 1;
    $response["content"] = "[SmartCMS] No request type defined!";
    echo json_encode($response);
} else {
    if(file_exists("config/installed")) {
        $conn = new DB();
        if($conn = false) {
            $response["code"] = 3;
            $response["content"] = "[SmartCMS] MySQL connection failed!";
            echo json_encode($response);
        }
    } else {
        $response["code"] = 2;
        $response["content"] = "[SmartCMS] This version of SmartCMS is not yet installed, please try again later!";
        echo json_encode($response);
    }
}

?>