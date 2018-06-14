<?php
$conn;
$port = "3306"; 
$conn = new mysqli($hostname, $user, $password, $dbname, $port);
if ($conn->connect_errno) {
    printf("Connect failed: %s", $conn->connect_error);
    exit();
}
mysqli_query($conn, "SET NAMES utf8");
mysqli_query($conn, "SET character_set_results=utf8");
mysqli_query($conn, "SET character_set_client=utf8");
mysqli_query($conn, "SET character_set_connection=utf8");
?>