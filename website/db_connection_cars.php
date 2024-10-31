<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_management";

$conn_cars = new mysqli($servername, $username, $password, $dbname);

if ($conn_cars->connect_error) {
    die("Connection failed: " . $conn_cars->connect_error);
}
?>
