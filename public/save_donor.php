<?php
include '../config/database.php';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$location = $_POST['location'] ?? '';

if (empty($name) || empty($email) || empty($location)) {
    header("Location: donors.php?error=Name, Email and Location are required");
    exit;
}

$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$location = $conn->real_escape_string($location);

// Check if email already exists
$checkEmail = $conn->query("SELECT id FROM donors WHERE email = '$email'");
if ($checkEmail && $checkEmail->num_rows > 0) {
    header("Location: donors.php?error=Email already exists");
    exit;
}

$conn->query("INSERT INTO donors (name,email,location)
VALUES ('$name','$email','$location')");

if ($conn->error) {
    header("Location: donors.php?error=" . urlencode($conn->error));
} else {
    header("Location: donors.php?success=Donor added successfully");
}
?>
