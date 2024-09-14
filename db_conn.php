<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "personnel";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

if (!$connection) {
    echo "Connection failed!";
}
?>