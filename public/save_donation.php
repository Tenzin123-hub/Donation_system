<?php
include '../config/database.php';

$donor_id = $_POST['donor_id'] ?? null;
$amount = $_POST['amount'] ?? null;
$donation_date = $_POST['donation_date'] ?? null;

// Debug: Remove after testing
error_log("POST data: donor_id=" . var_export($donor_id, true) . ", amount=" . var_export($amount, true));

if (empty($donor_id) || empty($amount) || empty($donation_date)) {
    header("Location: donations.php?error=Missing required fields - donor_id:$donor_id");
    exit;
}

$donor_id = intval($donor_id);
$amount = floatval($amount);
$donation_date = $conn->real_escape_string($donation_date);

$conn->query("INSERT INTO donations (donor_id,amount,donation_date)
VALUES ('$donor_id','$amount','$donation_date')");

if ($conn->error) {
    header("Location: donations.php?error=" . urlencode($conn->error));
} else {
    header("Location: donations.php?success=Donation saved successfully");
}
?>
