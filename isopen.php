<?php

$unparsedJson = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/openstatus.json");
$openStatusArray = json_decode($unparsedJson, true);

$course_id = $_GET["course_id"];
$action = $_GET["action"];


//die if both id and actions aren't set
if (!isset($course_id) || !isset($action)){
    die("Invalid input");
}

if ($action == "set"){

    if (array_key_exists($course_id, $openStatusArray)){
        if (isset($_GET["value"])) {

            $openStatusArray[$course_id]["isopen"] = (int)$_GET["value"];
            echo($openStatusArray[$course_id]["isopen"]);
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/openstatus.json", json_encode($openStatusArray));

        } else {
            die("No value provided");
        }
        
    } else {
        die("Invalid Key");
    }


    
} else {
    //Action is "GET"
    if (array_key_exists($course_id, $openStatusArray)){
        echo($openStatusArray[$course_id]["isopen"]);
    } else {
        die("Invalid Key");
    }
}