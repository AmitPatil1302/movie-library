<?php
$servername = "localhost";
$username = "root";
$password = "mysql"; // Use your MySQL root password here, usually it's empty for XAMPP
$dbname = "movie_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
