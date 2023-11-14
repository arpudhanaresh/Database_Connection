<?php
$host = "localhost";
$user = "datab";
$password = "datab";
$database = "arpudha";

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
