<?php
include '../config/database.php';

$conn->query("INSERT INTO donors (name,email,location)
VALUES ('$_POST[name]','$_POST[email]','$_POST[location]')");

header("Location: donors.php");
?>
