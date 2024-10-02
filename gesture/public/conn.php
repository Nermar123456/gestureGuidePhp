<?php
$servername = "localhost";
$username = "root";
$pass ="";
$dbname = "gesture_guide";

$conn = new mysqli($servername, $username, $pass, $dbname);


if($conn->connect_error){
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
} else {
    echo "";
}
?>