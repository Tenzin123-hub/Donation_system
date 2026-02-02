<?php
include '../config/database.php';
include '../includes/header.php';
?>

<h2>Add Donor</h2>

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

<table>
<tr>
<th>Name</th><th>Email</th><th>Location</th><th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM donors");
while ($row = $result->fetch_assoc()) {
?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['location'] ?></td>
<td>
<a href="edit_donor.php?id=<?= $row['id'] ?>">Edit</a> |
<a href="delete_donor.php?id=<?= $row['id'] ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<?php include '../includes/footer.php'; ?>
