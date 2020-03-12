<?php
require(getcwd() . "/connect.php");
session_start();



$sql = "SELECT * FROM `queue` WHERE `complete` = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    //return just the raw data if no format is specified
    if ($_GET["noformat"]){
        $my_array = array();
        while($row = $result->fetch_assoc()) {
            array_push($my_array, $row);
        }
        die(json_encode($my_array));
    }

    while($row = $result->fetch_assoc()) {
        //check admin status
        $tableRow = "";
        if ($_SESSION["admin"]){
            //generate buttons
            $icon = "<a href='/gotolink.php?link=". $row["link"] ."&id=". $row["id"] ."' target='_blank'>Go</a>";
            $complete = "<a href='/complete.php?id=". $row["id"] ."' id='complete-". $row["id"] ."'>Complete</a> ";


            $tableRow = "<td><p>" . $row["name"]. "</p></td><td><p>" . $row["in_progress"]. "</p></td><td>" . $icon . "</td><td>" . $complete . "</td>";
        } else {
            if ($row["in_progress"] == 1){
                $icon = '<ion-icon name="chatbox-ellipses-outline"></ion-icon>';
            } else {
                $icon = '<ion-icon name="chatbox-outline"></ion-icon>';
            }
            
            $tableRow = "<td><p>" . $row["name"]. "</p></td><td>" . $icon. "</td>";
        }

        //echo out table rows
        echo("<tr>");
        echo($tableRow);
        echo("</tr>");
    }
} else {
    $my_array = array();
    die(json_encode($my_array));


}
$conn->close();
?>