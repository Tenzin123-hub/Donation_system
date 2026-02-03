<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "donation_db";

// $host = "localhost";
// $username = "np03cs4a240262";
// $password = "SivVTLvQeZ";
// $database = "np03cs4a240262";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed");
}
?>
