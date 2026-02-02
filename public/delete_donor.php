<?php
include '../config/database.php';
$conn->query("DELETE FROM donors WHERE id=".$_GET['id']);
header("Location: donors.php");
?>
