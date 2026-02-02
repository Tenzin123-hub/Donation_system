<?php
include '../config/database.php';
include '../includes/header.php';
?>

<h2>Add Donation</h2>

<form method="post" action="save_donation.php">
Email:
<input type="email" onkeyup="getDonor(this.value)">
<input type="hidden" name="donor_id" id="donor_id"><br><br>

Amount:
<input type="number" name="amount"><br><br>

Date:
<input type="date" name="donation_date"><br><br>

<button>Save Donation</button>
</form>

<?php include '../includes/footer.php'; ?>
