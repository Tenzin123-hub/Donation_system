<?php
include '../config/database.php';

$id = $_GET['id'];
$row = $conn->query("SELECT * FROM donors WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
    $conn->query("UPDATE donors SET
    name='$_POST[name]',
    email='$_POST[email]',
    location='$_POST[location]'
    WHERE id=$id");
    header("Location: donors.php");
}
?>

<form method="post">
<input name="name" value="<?= $row['name'] ?>"><br><br>
<input name="email" value="<?= $row['email'] ?>"><br><br>
<input name="location" value="<?= $row['location'] ?>"><br><br>
<button name="update">Update</button>
</form>
