<?php
include '../config/database.php';

$conn->query("INSERT INTO donations (donor_id,amount,donation_date)
VALUES ('$_POST[donor_id]','$_POST[amount]','$_POST[donation_date]')");

header("Location: donations.php");
?>
