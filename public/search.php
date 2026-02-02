<?php
include '../config/database.php';
include '../includes/header.php';
?>

<form method="post">
<input type="text" name="location" placeholder="Search by location">
<button name="search">Search</button>
</form>

<?php
if (isset($_POST['search'])) {
    $loc = $_POST['location'];
    $r = $conn->query("SELECT donors.name, donations.amount
    FROM donors JOIN donations ON donors.id = donations.donor_id
    WHERE donors.location LIKE '%$loc%'");

    while ($row = $r->fetch_assoc()) {
        echo $row['name']." - ".$row['amount']."<br>";
    }
}
?>

<?php include '../includes/footer.php'; ?>
