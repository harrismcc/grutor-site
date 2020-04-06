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


    die();
    if (substr($_GET["link"], 0, 7) != "http://" || substr($_GET["link"], 0, 8) != "https://"){
        header("Location: http://" . $_GET["link"]);
    } else {
        header("Location: " . $_GET["link"]);
    }

    


}else{
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
    die("missing items");
}