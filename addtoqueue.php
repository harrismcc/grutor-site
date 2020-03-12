<?php
require(getcwd() . "/connect.php");


$name = mysqli_real_escape_string($conn, $_POST["name"]);
$link = mysqli_real_escape_string($conn, $_POST["link"]);
$section = mysqli_real_escape_string($conn, $_POST["section"]);

if (!$name || !$link){
    die("Error invalid inputs");
}


$sql = "INSERT INTO `queue` (`name`, `link`, `section`) VALUES ('". $name ."', '". $link ."','" . $section . "');";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

//header("Location:" . getcwd() . "/index.php");

?>