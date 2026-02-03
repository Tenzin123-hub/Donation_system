<?php
include '../config/database.php';

header('Content-Type: application/json');

$email = $_GET['email'] ?? '';
$action = $_GET['action'] ?? 'get';

if (empty($email)) {
    echo json_encode(['id' => null, 'error' => 'Email is required']);
    exit;
}

$email = $conn->real_escape_string(trim($email));

// Check if donor exists
$result = $conn->query("SELECT id FROM donors WHERE email = '$email'");

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['id' => intval($row['id']), 'error' => null, 'created' => false]);
} else {
    // Auto-create donor if not found
    $name = explode('@', $email)[0]; // Use email prefix as name
    $insert = $conn->query("INSERT INTO donors (name, email) VALUES ('$name', '$email')");
    
    if ($insert) {
        $newId = $conn->insert_id;
        echo json_encode(['id' => intval($newId), 'error' => null, 'created' => true, 'message' => 'New donor created automatically']);
    } else {
        echo json_encode(['id' => null, 'error' => 'Failed to create donor: ' . $conn->error]);
    }
}
?>

