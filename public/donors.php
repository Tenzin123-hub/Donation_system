<?php
include '../config/database.php';
include '../includes/header.php';
?>

<h2>Add Donor</h2>

<?php
if (isset($_GET['error'])) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($_GET['error']) . '</p>';
}
if (isset($_GET['success'])) {
    echo '<p style="color: green;">' . htmlspecialchars($_GET['success']) . '</p>';
}
?>

<form method="post" action="save_donor.php">
    Name:<br>
    <input type="text" name="name" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    Location:<br>
    <input type="text" name="location" required><br><br>

    <button>Save Donor</button>
</form>

<hr>

<h2>Donor List</h2>

<table border="1" cellpadding="10">
<tr>
<th>Name</th><th>Email</th><th>Location</th><th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM donors");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<tr>
<td><?= htmlspecialchars($row['name']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['location']) ?></td>
<td>
<a href="edit_donor.php?id=<?= $row['id'] ?>">Edit</a> |
<a href="delete_donor.php?id=<?= $row['id'] ?>">Delete</a>
</td>
</tr>
<?php 
    }
} else {
    echo '<tr><td colspan="4">No donors found</td></tr>';
}
?>
</table>

<?php include '../includes/footer.php'; ?>
