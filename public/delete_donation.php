<?php
include '../config/database.php';

$id = $_GET['id'] ?? null;

if (empty($id)) {
    header("Location: donations.php?error=Invalid donation ID");
    exit;
}

$id = intval($id);
$conn->query("DELETE FROM donations WHERE id = $id");

if ($conn->error) {
    header("Location: donations.php?error=" . urlencode($conn->error));
} else {
    header("Location: donations.php?success=Donation deleted successfully");
}
?>
