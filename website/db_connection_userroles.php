<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manager_users";

$conn_users = new mysqli($servername, $username, $password, $dbname);

if ($conn_users->connect_error) {
    die("Connection to manager_users failed: " . $conn_users->connect_error);
}
?>
