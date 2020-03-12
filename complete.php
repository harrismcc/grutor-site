<?php
require(getcwd() . "/connect.php");
session_start();

if ($_GET["id"]){
    $sql = "UPDATE `queue` SET `complete` = '1' WHERE `queue`.`id` = " . $_GET["id"];
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();


}else{
    die();
}