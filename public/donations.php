<?php
include '../config/database.php';
include '../includes/header.php';
?>

<h2>Add Donation</h2>

<?php
if (isset($_GET['error'])) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($_GET['error']) . '</p>';
}
if (isset($_GET['success'])) {
    echo '<p style="color: green;">' . htmlspecialchars($_GET['success']) . '</p>';
}
?>

<form method="post" action="save_donation.php" onsubmit="return validateForm()">
Email:
<input type="email" name="email" id="email" onkeyup="getDonor(this.value)" required>
<input type="hidden" name="donor_id" id="donor_id"><br><br>

Amount:
<input type="number" name="amount" step="0.01" min="0" required><br><br>

Date:
<input type="date" name="donation_date" required><br><br>

<button type="submit">Save Donation</button>
</form>

<script>
function validateForm() {
    var donorId = document.getElementById("donor_id").value;
    var amount = document.getElementById("amount").value;
    var donationDate = document.getElementById("donation_date").value;
    
    if (!donorId || donorId === '') {
        alert('Please select a valid donor by entering a registered email.');
        return false;
    }
    
    if (!amount || amount === '' || amount <= 0) {
        alert('Please enter a valid amount.');
        return false;
    }
    
    if (!donationDate || donationDate === '') {
        alert('Please select a donation date.');
        return false;
    }
    
    return true;
}
</script>

<hr>

<h2>Donation List</h2>

<table border="1" cellpadding="10">
<tr>
<th>Donor Name</th><th>Email</th><th>Amount</th><th>Date</th><th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT d.id, d.donor_id, d.amount, d.donation_date, donor.name, donor.email 
                        FROM donations d 
                        JOIN donors donor ON d.donor_id = donor.id
                        ORDER BY d.donation_date DESC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<tr>
<td><?= htmlspecialchars($row['name']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td>$<?= number_format($row['amount'], 2) ?></td>
<td><?= htmlspecialchars($row['donation_date']) ?></td>
<td>
<a href="delete_donation.php?id=<?= $row['id'] ?>">Delete</a>
</td>
</tr>
<?php 
    }
} else {
    echo '<tr><td colspan="5">No donations found</td></tr>';
}
?>
</table>

<?php include '../includes/footer.php'; ?>
