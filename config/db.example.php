<?php
$host = "localhost";
$user = "your_username";
$password = "your_password";
$database = "lost_found_system";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed");
}
?>
