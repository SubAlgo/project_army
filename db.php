<?php
/*
$database_server = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'pj_army';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'pj_army';
*/

$conn = new mysqli($database_server, $database_user, $database_password, $database_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_set_charset($conn, "utf8");
    
?>