<?php
require(getcwd() . "/connect.php");
session_start();

if ($_SESSION["admin"] && $_GET["id"]){
    $sql = "UPDATE `queue` SET `in_progress` = '1' WHERE `queue`.`id` = " . $_GET["id"];
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();



    header("Location: " . $_GET["link"]);


}else{
    die();
}